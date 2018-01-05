<?php

namespace backend\controllers;

use backend\filters\CheckFilter;
use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use flyok666\qiniu\Qiniu;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Request;

class GoodsController extends \yii\web\Controller
{
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }

//    public function behaviors()
//    {
//        return [
//
//            'rbac'=>[
//
//                'class'=>CheckFilter::className(),
//            ]
//        ];
//    }

    public function actionIndex()
    {
        $models=Goods::find();

        $request=\Yii::$app->request;
        //得到搜索条件
        $minPrice=$request->get('minPrice');
        $maxPrice=$request->get('maxPrice');
        $keyword=$request->get('keyword');
        $status=$request->get('status');

        if($minPrice){
            $models->andWhere("market_price>={$minPrice}");
        }
        if($maxPrice){
            $models->andWhere("shop_price<={$maxPrice}");
        }
        if($keyword){
            $models->andWhere("name like '%{$keyword}%' or sn like '{$keyword}'");
        }
        if($status=="1"){
            $models->andWhere("status=1");
        }
        if($status=="2"){
            $models->andWhere("status=2");
        }

        $pages = new Pagination(
            [

                'totalCount' => $models->count(),
                'pageSize' => 2
            ]
        );
        $models = $models->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'models' => $models,
            'pages' => $pages,
        ]);
    }
//添加
public function actionAdd(){
        $model=new Goods();
        $request=new Request();
        $intro=new GoodsIntro();
        //得到所有商品的分类
        $category=GoodsCategory::find()->asArray()->all();
        //得到所有品牌的分类
        $brand=Brand::find()->asArray()->all();
        //商品转化成键对值
        $cateArr=ArrayHelper::map($category,'id','name');
        //品牌转化成键对值
        $brandArr=ArrayHelper::map($brand,'id','name');

    if ($request->isPost) {
        //绑定数据
        $model->load($request->post());
        //验证
        if ($model->validate()) {
            //判断货号是否存在
            if(empty($model->sn)){
                //货号为空自动生成  格式为年月日加今天的第几个商品
                $time=strtotime(date('Ymd'));
                //查询出今天数据库中添加了多少商品
                $count=Goods::find()->where("inputtime>={$time}")->count();
                $count=$count+1;
                //拼接4位货号
                $count=substr("000".$count,-4);
                //得到最终得货号
                $model->sn=date("Ymd").$count;



            }

            //验证成功保存数据
            if ($model->save()) {

                //保存

                //保存商品简介到goods_intro中
                $intro->load($request->post());
                $intro->goods_id=$model->id;
                $intro->save();
                //循环添加保存多图
                foreach ($model->imagesFile as $img){
                    //new新对象（一定要在这里new）
                    $goodsGallery=new GoodsGallery();
                    //赋值
                    $goodsGallery->goods_id=$model->id;
                    $goodsGallery->path=$img;
                    $goodsGallery->save();

                }

                //跳转到首页
                return $this->redirect(['index']);

            }



        }
    }

        return $this->render('add', ['model' => $model,'cateArr'=>$cateArr,'brandArr'=>$brandArr,'intro'=>$intro]);
}


//编辑

    /**
     * @param $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id){
        $model=Goods::findOne($id);
        $request=new Request();
        $intro=GoodsIntro::find()->where($goods_id=$id)->one();
        //回显多图
        $imagesFile=GoodsGallery::find()->where($goods_id=$id)->asArray()->all();
        //将处理好的数据赋值给imagesFile
        $model->imagesFile=array_column($imagesFile,'path');
        //得到所有商品的分类
        $category=GoodsCategory::find()->all();
        //得到所有品牌的分类
        $brand=Brand::find()->all();
        //商品转化成键对值
        $cateArr=ArrayHelper::map($category,'id','name');
        //品牌转化成键对值
        $brandArr=ArrayHelper::map($brand,'id','name');

        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
            //验证
            if ($model->validate()) {
                //判断货号是否存在
                if(empty($model->sn)){
                    //货号为空自动生成  格式为年月日加今天的第几个商品
                    $time=strtotime(date('Ymd'));
                    //查询出今天数据库中添加了多少商品
                    $count=Goods::find()->where("inputtime>={$time}")->count();
                    $count=$count+1;
                    //拼接4位货号
                    $count=substr("000".$count,-4);
                    //得到最终得货号
                    $model->sn=date("Ymd").$count;



                }

                //验证成功保存数据
                if ($model->save()) {

                    //保存

                    //保存商品简介到goods_intro中
                    $intro->load($request->post());
                    $intro->goods_id=$model->id;
                    $intro->save();
                    //循环添加保存多图
                    foreach ($model->imagesFile as $img){
                        //new新对象（一定要在这里new）
                        $goodsGallery=new GoodsGallery();
                        //赋值
                        $goodsGallery->goods_id=$model->id;
                        $goodsGallery->path=$img;
                        $goodsGallery->save();

                    }

                    //跳转到首页
                    return $this->redirect(['index']);

                }



            }
        }

        return $this->render('add', compact('model','intro','cateArr','brandArr'));
    }


//删除
public function actionDel($id){
        if(Goods::findOne($id)->delete()){
            \Yii::$app->session->setFlash("seccuss","删除成功");
            return $this->redirect(['index']);
        }
}
//上传文件方法
    public function actionUpload2()
    {
//        $files = UploadedFile::getInstanceByName("file");
//        //判定有没有上传
//        if ($files) {
//            //拼接路径
//            $path = "images/brand/" . time() . '.' . $files->extension;
//            //移动图片
//            if ($files->saveAs($path, false)) {
//                //保存图片
//                $result = [
//                    'code' => 0,
//                    'url' => "/" . $path,
//                    'attachment' => $path
//                ];
//                echo json_encode($result);
//            }
//
//        }fghj
        $config = [
            'accessKey' => '1lCVCjQssxVs4osNrHGZy7Cu7RU7t7YXeVWhE4uf',//AK
            'secretKey' => 'wyp-P0wXyTsJy5GwCOQ0oCYo9uIzMBTxs2o8G1zT',//SK
            'domain' => 'http://p1jtshf46.bkt.clouddn.com',//临时域名
            'bucket' => 'yiyishop',//空间名称
            'area' => Qiniu::AREA_HUANAN//区域

        ];
        //实例化qiniu
        $qiniu=new Qiniu($config);
        $key=uniqueId();//上传文件名
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);//调用上传方法上传文件
        $url=$qiniu->getLink($key);
        //返回的结果
        $result=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url
        ];
        return json_encode($result);
    }




}

<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsIntro;
use flyok666\qiniu\Qiniu;
use yii\helpers\ArrayHelper;
use yii\web\Request;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models=Goods::find()->all();
        return $this->render('index',compact('models'));
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
            //验证成功保存数据
            $model->save();
            //保存商品简介到goods_intro中
            $intro->load($request->post());
            $intro->goods_id=$model->id;
            $intro->save();
            //跳转到首页
            return $this->redirect(['index']);

        }
    }

        return $this->render('add', ['model' => $model,'cateArr'=>$cateArr,'brandArr'=>$brandArr,'intro'=>$intro]);
}


//编辑
    public function actionEdit($id){
        $model=Goods::findOne($id);
        $request=new Request();

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
                //验证成功保存数据
                $model->save();
                return $this->redirect(['index']);
            }
        }

        return $this->render('add', ['model' => $model,'cateArr'=>$cateArr,'brandArr'=>$brandArr]);
    }


//删除
public function actionDel($id){
        if(Goods::findOne($id)->delete()){
            \Yii::$app->session->setFlash("seccuss","删除成功");
            return $this->redirect(['index']);
        }
}
//上传文件方法
    public function actionUpload()
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
//        }
        $config = [
            'accessKey' => '1lCVCjQssxVs4osNrHGZy7Cu7RU7t7YXeVWhE4uf',//AK
            'secretKey' => 'wyp-P0wXyTsJy5GwCOQ0oCYo9uIzMBTxs2o8G1zT',//SK
            'domain' => 'http://p1jtshf46.bkt.clouddn.com',//临时域名
            'bucket' => 'yiyishop',//空间名称
            'area' => Qiniu::AREA_HUANAN//区域

        ];
        //实例化qiniu
        $qiniu=new Qiniu($config);
        $key=time();//上传文件名
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

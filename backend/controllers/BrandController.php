<?php

namespace backend\controllers;
use flyok666\qiniu\Qiniu;
use backend\models\Brand;
use yii\web\Request;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    //显示所有数据
    public function actionIndex()
    {
        $models = Brand::find()->all();
        return $this->render('index', compact('models'));
    }

    //添加数据
    public function actionAdd()
    {
        $model = new Brand();
        $request = new Request();
        //判断是否是post提交
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());

                //验证
                if ($model->validate()) {
                    //验证成功保存数据
                    if ($model->save()) {
                        //跳转到首页
                        return $this->redirect(['index']);
                    } else {
                        var_dump($model->errors);
                    }
                }



        }
        return $this->render('add', ['model' => $model]);
    }

//编辑数据
    public function actionEdit($id)
    {
        $model = Brand::findOne($id);
        $request = new Request();
        //判断是否是post提交
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());

            //验证
            if ($model->validate()) {
                //验证成功保存数据
                if ($model->save()) {
                    //跳转到首页
                    return $this->redirect(['index']);
                } else {
                    var_dump($model->errors);
                }
            }



        }
        return $this->render('add', ['model' => $model]);
    }

    //删除数据
    public function actionDel($id)
    {
        if (Brand::findOne($id)->delete()) {
            unlink(Brand::findOne($id)->logo);
            \yii::$app->session->setFlash("success", "删除成功");
            return $this->redirect(['index']);
        }
    }

    //声明一个方法上传文件
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
            'accessKey' => 'EAd29Qrh05q78_cZhajAWcbB1wYCBLyHLqkanjOG',//AK
            'secretKey' => '_R5o3ZZpPJvz8bNGBWO9YWSaNbxIhpsedbiUtHjW',//SK
            'domain' => 'http://p1ht4b07w.bkt.clouddn.com',//临时域名
            'bucket' => 'php0830',//空间名称
            'area' => Qiniu::AREA_HUADONG//区域
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

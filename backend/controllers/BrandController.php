<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\web\Request;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{
    //显示所有数据
    public function actionIndex()
    {
        $models=Brand::find()->all();
        return $this->render('index',compact('models'));
    }
    //添加数据
    public function actionAdd(){
        $model=new Brand();
        $request=new Request();
        //判断是否是post提交
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
            //接收上传得文件
            $model->imagesFile=UploadedFile::getInstance($model,"imagesFile");
            //编写地址
            $imagesPath="images/".time().".".$model->imagesFile->extension;
            //保存上传的文件
            $uploadResult=$model->imagesFile->saveAs(\yii::getAlias("@webroot/").$imagesPath,false);
            //判断是否保存成功
            if ($uploadResult) {
                //保存上传文件路径到数据库
                $model->logo=$imagesPath;
                //验证
                if ($model->validate()) {
                    //验证成功保存数据
                    if ($model->save()) {
                        //跳转到首页
                        return $this->redirect(['index']);
                    }else{
                        var_dump($model->errors);
                    }
                }
            }


        }
        return $this->render('add', ['model' => $model]);
    }
//编辑数据
    public function actionEdit($id){
        $model=Brand::findOne($id);
        $request=new Request();
        //判断是否是post提交
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
            //接收上传得文件
            $model->imagesFile=UploadedFile::getInstance($model,"imagesFile");
            if($model->validate()){
                //定义上传路径
                $imagesPath=$model->logo;
                //判断是否上传了文件
                if($model->imagesFile){
                    //删除之前的图片
                    unlink($imagesPath);
                    //编写地址
                    $imagesPath="images/".time().".".$model->imagesFile->extension;
                    //保存上传的文件
                    $uploadResult=$model->imagesFile->saveAs(\yii::getAlias("@webroot/").$imagesPath,false);
                }

                //判断是否保存成功
                if ($uploadResult) {
                    //保存上传文件路径到数据库
                    $model->logo=$imagesPath;
                    //验证
                    if ($model->validate()) {
                        //验证成功保存数据
                        if ($model->save()) {
                            //跳转到首页
                            return $this->redirect(['index']);
                        }
                    }
                }
            }else{
                var_dump($model->errors);
            }



        }
        return $this->render('add', ['model' => $model]);
    }

    //删除数据
    public function actionDel($id){
        if(Brand::findOne($id)->delete()){
            unlink(Brand::findOne($id)->logo);
            \yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['index']);
        }
    }
}

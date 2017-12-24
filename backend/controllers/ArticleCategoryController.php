<?php

namespace backend\controllers;

use backend\models\ArticleCategory;
use yii\web\Request;

class ArticleCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models=ArticleCategory::find()->all();
        return $this->render('index', ['models' => $models]);
    }
    //添加数据
    public function actionAdd(){
        $model=new ArticleCategory();
        $request=new Request();
        if($request->isPost){
            $model->load($request->post());

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


        return $this->render('add', ['model' => $model]);
    }

    //编辑数据
    public function actionEdit($id){

        $model=ArticleCategory::findOne($id);
        $request=new Request();
        $model->load($request->post());
        if($request->isPost){
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


        return $this->render('add', ['model' => $model]);
    }
    //删除
    public function actionDel($id){
        if(ArticleCategory::findOne($id)->delete()){
            
            \yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['index']);
        }
    }
}

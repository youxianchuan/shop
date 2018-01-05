<?php

namespace backend\controllers;

use backend\filters\CheckFilter;
use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleDetail;
use yii\helpers\ArrayHelper;
use yii\web\Request;

class ArticleController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [

            'rbac'=>[

                'class'=>CheckFilter::className(),
            ]
        ];
    }
    public function actions()
    {
        return [
            'upload' => [
                'class' => 'kucha\ueditor\UEditorAction',
            ]
        ];
    }
    public function actionIndex()
    {
        $models=Article::find()->all();
        return $this->render('index',compact("models"));
    }

//添加数据
public function actionAdd(){
        //实例化MODEL
        $model=new Article();
        $request=new Request();
    $detail=new ArticleDetail();
    //得到所有文章分类
    $category=ArticleCategory::find()->asArray()->all();
    //转换成建对值
    $cateArr=ArrayHelper::map($category,'id','name');
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            //验证
            if ($model->validate()) {
                $model->inputtime=date("Y-m-d H:i:s");
                //验证成功保存数据

                 ($model->save());
                    //跳转到首页
                    $detail->load($request->post());
                    $detail->article_id=$model->id;
                    $detail->save();
                    return $this->redirect(['index']);

            }else{
                var_dump($model->errors);
            }

        }
        return $this->render('add', ['model' => $model,'detail'=>$detail,'cateArr'=>$cateArr]);
}
//编辑
    public function actionEdit($id){
        //实例化MODEL
        $model=Article::findOne($id);
        $request=new Request();
        $detail=ArticleDetail::find()->where(['article_id'=>$id])->one();

        //得到所有文章分类
        $category=ArticleCategory::find()->asArray()->all();
        //转换成建对值
        $cateArr=ArrayHelper::map($category,'id','name');
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            //验证
            if ($model->validate()) {
                $model->inputtime=date("Y-m-d H:i:s");
                //验证成功保存数据

                ($model->save());
                //跳转到首页
                $detail->load($request->post());
                $detail->article_id=$model->id;
                $detail->save();
                return $this->redirect(['index']);

            }else{
                var_dump($model->errors);
            }

        }
        return $this->render('add', ['model' => $model,'detail'=>$detail,'cateArr'=>$cateArr]);
    }

    //删除
    public function actionDel($id){
        if(Article::findOne($id)->delete()){
            \yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['index']);
        }
    }

}

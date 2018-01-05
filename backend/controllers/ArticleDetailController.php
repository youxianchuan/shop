<?php

namespace backend\controllers;

use backend\filters\CheckFilter;
use backend\models\ArticleDetail;
use yii\web\Request;

class ArticleDetailController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [

            'rbac'=>[

                'class'=>CheckFilter::className(),
            ]
        ];
    }
    /**
     * @return string
     */
    public function actionIndex()
    {
        $models=ArticleDetail::find()->all();
        return $this->render('index',compact('models'));
    }
    //添加数据
    public function actionAdd(){
        $model=new ArticleDetail();
        $request=new Request();
        //判断是否是POST提交
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
            //验证
            if ($model->validate()) {
                //验证成功保存数据
                if ($model->save()) {
                    return $this->redirect(['index']);
                }else{
                    var_dump($model->errors);
                }
            }
        }
        return $this->render('add', ['model' => $model]);
    }


}

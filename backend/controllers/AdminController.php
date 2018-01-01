<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\LoginForm;
use yii\web\Request;

class AdminController extends \yii\web\Controller
{
    public $defaultAction = 'login';
    public function actionIndex()
    {
        $model=new Admin();
        return $this->render('login',compact('model'));
    }

    public function actionAdd(){
        $model=new Admin();
        $request=new Request();
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
            $model->password=\Yii::$app->security->generatePasswordHash($model->password);
            //随便字符串
            $model->token=\Yii::$app->security->generateRandomString();
            //验证
            if ($model->validate()) {
                //验证成功保存数据
                $model->save();
                \Yii::$app->session->setFlash("success","注册成功");
                \Yii::$app->user->login($model,3600*24*7);
                //跳转到登陆页面
                return $this->redirect(['brand/index']);
            }else{
                var_dump($model->errors);
            }
        }
        return $this->render('add',['model'=>$model]);
    }

    public function actionLogin()

    {
   $model=new LoginForm();
   $requst=new Request();
        if ($requst->isPost) {
            //绑定
            $model->load($requst->post());
            if($model->validate()){
                //判断有没有用户名
                $admin=Admin::findOne(['username'=>$model->username]);
                if($admin){
                    //存在判断密码
                    if(\Yii::$app->security->validatePassword($model->password,$admin->password)){
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                        //跳转
                        return $this->redirect(['brand/index']);
                    }else{
                        //密码错误
                        $model->addError("password","密码错误");
                    }
                }else{
                    //不存在  提示没有用户名
                    $model->addError("username","用户名不存在");
                }
            }
        }
   return $this->render('login', ['model' => $model]);
    }

}

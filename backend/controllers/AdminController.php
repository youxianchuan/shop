<?php

namespace backend\controllers;

use backend\filters\CheckFilter;
use backend\models\Admin;
use backend\models\LoginForm;
use yii\helpers\ArrayHelper;
use yii\web\Request;

class AdminController extends \yii\web\Controller
{
    public $defaultAction = 'login';
    //public function behaviors()
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
        $models=Admin::find()->all();
        return $this->render('index',['models'=>$models]);
    }

    public function actionAdd(){
        $model=new Admin();
        $request=new Request();
        $auth=\Yii::$app->authManager;
        $prem=$auth->getRoles();

        $presArr=ArrayHelper::map($prem,'name','name');

        $model->setScenario('add');
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());

            $model->password=\Yii::$app->security->generatePasswordHash($model->password);
            //随便字符串
            $model->token=\Yii::$app->security->generateRandomString();
            $model->last_login_ip=ip2long($request->userIP);
            //验证
            if ($model->validate()) {
                //验证成功保存数据


                $model->save();

                //找到角色
               $role=$auth->getRole($model->role);

                $auth->assign($role,$model->id);
                \Yii::$app->session->setFlash("success","注册成功");
                \Yii::$app->user->login($model,3600*24*7);
                //跳转到登陆页面
                return $this->redirect(['index']);
            }else{
                var_dump($model->errors);
            }
        }
        return $this->render('add',['model'=>$model,'presArr'=>$presArr]);
    }

    //编辑
    public function actionEdit($id){


       $model=Admin::findOne($id);
        $password=$model->password;
       $model->setScenario('edit');
       $model->password='';
       $auth=\Yii::$app->authManager;
        $prem=$auth->getRoles();

        $presArr=ArrayHelper::map($prem,'name','name');



        $request=new Request();
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
          //  var_dump($request->post()["Admin"]["password"]);exit;



            //随便字符串
            $model->token=\Yii::$app->security->generateRandomString();
            $model->last_login_ip=ip2long($request->userIP);
            //验证
            if ($model->validate()) {

                if(empty($request->post()["Admin"]["password"])){

                    $model->password=$password;

                }else{

                    $model->password=\Yii::$app->security->generatePasswordHash($request->post()["Admin"]["password"]);


                }
                //验证成功保存数据
                $model->save();
                //找到角色
                $role=$auth->getRole($model->role);

                $auth->update($model->role,$role);
                \Yii::$app->session->setFlash("success","修改成功");
                \Yii::$app->user->login($model,3600*24*7);
                //跳转到登陆页面
                return $this->redirect(['index']);
            }else{
                var_dump($model->errors);
            }
        }
        return $this->render('add',['model'=>$model,'presArr'=>$presArr]);
    }

    public function actionLogin()

   {
//        if (!\Yii::$app->user->isGuest) {
//            return $this->redirect(['login']);
//
//        }
        $model=new LoginForm();
        $requst=new Request();

        if ($requst->isPost) {
            //绑定
            $model->load($requst->post());
//            $requst->post()["LoginForm"];
//            $model->username= $requst->post()["LoginForm"]["username"];
//           $model->password= $requst->post()["LoginForm"]["password"];
//            $model->setScenario('login');

            if($model->validate()){
                //1.判断有没有用户名
//                var_dump($model);
//                exit;
                $admin=Admin::findOne(['username'=>$model->username]);

                if($admin){

                    //2.存在判断密码
                    if(\Yii::$app->security->validatePassword($model->password,$admin->password)){

                        //3.密码正确，用user组件登陆
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                        //4.修改登陆IP和时间
                        $admin->last_login_ip=ip2long(\Yii::$app->request->userIP);
                        $admin->last_login_time=time();

                        var_dump( $admin->save());
                        //跳转
                        return $this->redirect(['index']);
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


    //删除
    public function actionDel($id){
        if(Admin::findOne($id)->delete()){
            \Yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['index']);
        }
    }
        public function actionLogout(){
        if(\Yii::$app->user->logout()){
            return $this->redirect(['login']);
        }
        }
}

<?php
namespace backend\controllers;

use backend\filters\CheckFilter;
use backend\models\Admin;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\Request;

/**
 * Site controller
 */
class SiteController extends Controller
{



    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'rbac'=>[

                'class'=>CheckFilter::className(),
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $model=new Admin();
        $request=new Request();
        if($request->isPost){
            //绑定数据
            $model->load($request->post());
            //验证有没有当前用户名
            $admins=Admin::find()->where(['username'=>$model->username])->one();
            //判断$admin是否存在
            if ($admins){

                //验证密码
                if($admins->passworld==$model->passworld){
                    //验证成功 保存session
                    //调用user组件实现登陆

                    /** @var TYPE_NAME $admins */

                        \yii::$app->session->setFlash("success","登陆成功");
                        return $this->redirect(['brand/index']);

                }else{


                    $model->addError("passworld","密码错误");
                };

            }else{


                // return \yii::$app->session->setFlash("danger","用户名不存在");
                $model->addError("username","用户名不存在");
            }
        };

        return $this->render('login',compact('model'));
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

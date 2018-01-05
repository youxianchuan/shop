<?php

namespace backend\controllers;

use backend\filters\CheckFilter;
use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{



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
        //实例化authManager组件
        $auth=\Yii::$app->authManager;
        //得到所有权限
        $premissions=$auth->getPermissions();
        return $this->render('index',compact('premissions'));
    }

    public function actionAdd(){
        $model=new AuthItem();
        $auth=\Yii::$app->authManager;
        $requset=\Yii::$app->request;
        //判断是不是post提交
        if ($model->load($requset->post()) && $model->validate()) {
            //1.创建权限
            $permission=$auth->createPermission($model->name);
            //2.设置权限描述
            $permission->description=$model->description;
            //3.添加入库
            if ($auth->add($permission)) {
                //添加成功提示
                \Yii::$app->session->setFlash("success",'添加权限'.$model->name.'成功');
                //刷新页面
                return $this->refresh();
            }
        }

        return $this->render('add',compact('model'));
    }

    //编辑
    public function actionEdit($name){
        $model=AuthItem::findOne($name);
        $auth=\Yii::$app->authManager;
        $requset=\Yii::$app->request;
        //判断是不是post提交
        if ($model->load($requset->post()) && $model->validate()) {
            //1.找到对应的权限
            $permission=$auth->getPermission($model->name);
            //判断
            if($permission){
                //2.设置权限描述
                $permission->description=$model->description;
                //3.添加入库
                if ($auth->update($name,$permission)) {
                    //添加成功提示
                    \Yii::$app->session->setFlash("success",'修改权限'.$model->name.'成功');
                    //刷新页面
                    return $this->redirect(['index']);
                }
            }

        }

        return $this->render('edit',compact('model'));
    }

    //删除
    public function actionDel($name)
    {
        //实例化
        $auth=\Yii::$app->authManager;
        //找到对象
        $premission=$auth->getPermission($name);
        //判断
        if($auth->remove($premission)){
            \Yii::$app->session->setFlash("danger",'删除权限'.$name.'成功');
                return $this->redirect(['index']);
        }
    }

}

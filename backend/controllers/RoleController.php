<?php

namespace backend\controllers;

use backend\filters\CheckFilter;
use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{


    public function behaviors()
    {
        return [

            'rbac'=>[

                'class'=>CheckFilter::className(),
            ]
        ];
    }
    public function actionIndex()
    {
        //实例化authManager组件
        $auth=\Yii::$app->authManager;
        //得到所有权限
        $roles=$auth->getRoles();

        return $this->render('index', ['roles' => $roles]);
    }

    public function actionAdd(){
        $model=new AuthItem();
        $auth=\Yii::$app->authManager;
        $prem=$auth->getPermissions();
        $presArr=ArrayHelper::map($prem,'name','description');
        //判断
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            //1.创建角色
            $role=$auth->createRole($model->name);
            //2.设置角色描述
            $role->description=$model->description;
            //3.添加入库
            if($auth->add($role)){
                if($model->premissions){
                    //4.循环添加权限
                    foreach ($model->premissions as $premissionName){
                        //通过权限描述找到权限对象
                        $premission=$auth->getPermission($premissionName);
                        //把权限加入到角色中
                        $auth->addChild($role,$premission);

                    }

                }
                \Yii::$app->session->setFlash("success",'添加角色'.$model->name.'成功');
                //刷新
                return $this->refresh();
            }
        }
        return $this->render('add', ['model' => $model,'presArr'=>$presArr]);
    }

    //编辑
    public function actionEdit($name){
        $model=AuthItem::findOne($name);
        $auth=\Yii::$app->authManager;
        //通过角色找权限
        $roles=$auth->getPermissionsByRole($name);
        //取出所有权限的key值
        $model->premissions=array_keys($roles);
        $prem=$auth->getPermissions();
        $presArr=ArrayHelper::map($prem,'name','description');
        //判断
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            //1.找到角色
            $role=$auth->getRole($model->name);
            //2.设置角色描述
            $role->description=$model->description;
            //3.添加入库
            if($auth->update($name,$role)){
                $auth->removeChildren($role);
                if($model->premissions){
                    //4.循环添加权限
                    foreach ($model->premissions as $premissionName){
                        //通过权限描述找到权限对象
                        $premission=$auth->getPermission($premissionName);
                        //把权限加入到角色中
                        $auth->addChild($role,$premission);

                    }

                }
                \Yii::$app->session->setFlash("success",'更改角色'.$model->name.'成功');
                //刷新
                return $this->redirect(['index']);
            }
        }

        return $this->render('edit', ['model' => $model,'presArr'=>$presArr]);
    }

    //删除
    public function actionDel($name)
    {
        //实例化
        $auth=\Yii::$app->authManager;
        //找到对象
        $role=$auth->getRole($name);
        //判断
        if($auth->remove($role)){
            \Yii::$app->session->setFlash("danger",'删除角色'.$name.'成功');
            return $this->redirect(['index']);
        }
    }
}

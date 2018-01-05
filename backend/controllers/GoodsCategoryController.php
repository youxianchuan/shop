<?php

namespace backend\controllers;

use backend\filters\CheckFilter;
use backend\models\GoodsCategory;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Request;
use yii\web\Controller;
use yii;
use yii\db\Exception;
class GoodsCategoryController extends Controller
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
//        $models=GoodsCategory::find()->all();
//        $dataProvider = new ActiveDataProvider([
//
//            'query' => $models,
//            'pagination' => false
//        ]);
//
//
//
//
//        return $this->render('index',['dataProvider'=>$dataProvider, 'models' => $models ]);
        $query = GoodsCategory::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider
        ]);
    }


    //添加
    public function actionAdd(){
        $model=new GoodsCategory();
        $request=new Request();
        //找到所有数据并转化成数组
        $cates=GoodsCategory::find()->asArray()->all();
        //添加一个一级目录
        $cates[]=['id'=>0,'name'=>'一级目录','parent_id'=>0];
        //转化成JSON格式
        $cares=Json::encode($cates);
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());
            //验证
            if ($model->validate()) {
                if($model->parent_id==0){
                    //1.如果parent_id=0创建一级分类
                    $model->makeRoot();
                    \Yii::$app->session->setFlash("success","添加一级分类".$model->name."成功");
                }else{
                    //2.添加到对应的父类
                    //2.1找到父节点
                    $cateParent=GoodsCategory::findOne($model->parent_id);
                    //2.2创建一个新的节点
                    //2.3把新的节点添加到对应的父节点中
                    $model->prependTo($cateParent);
                    \Yii::$app->session->setFlash("success","把".$model->name."添加到".$cateParent->name."中");
                }
                //刷新
                return $this->refresh();
            }

        }
        return $this->render('add', ['model' => $model,'cates'=>$cates]);
    }

    //添加
    public function actionUpdate($id){
        $model=GoodsCategory::findOne($id);
        $request=new Request();
        //找到所有数据并转化成数组
        $cates=GoodsCategory::find()->asArray()->all();
        //添加一个一级目录
        $cates[]=['id'=>0,'name'=>'一级目录','parent_id'=>0];
        //转化成JSON格式
        $cares=Json::encode($cates);
        if ($request->isPost) {
            //绑定数据
            $model->load($request->post());

            //验证
            if ($model->validate()) {
                //捕获异常
                try{
                    if($model->parent_id==0){
                        //1.如果parent_id=0创建一级分类
                        $model->save();
                        \Yii::$app->session->setFlash("success","添加一级分类".$model->name."成功");
                    }else{
                        //2.添加到对应的父类
                        //2.1找到父节点
                        $cateParent=GoodsCategory::findOne($model->parent_id);
                        //2.2创建一个新的节点
                        //2.3把新的节点添加到对应的父节点中
                        $model->prependTo($cateParent);

                        \Yii::$app->session->setFlash("success","编辑成功");
                    }
                    //刷新
                    return $this->redirect(['index']);

                }catch (Exception $exception){
                        \Yii::$app->session->setFlash("danger",$exception->getMessage());
                        return $this->refresh();

                }


            }

        }
        return $this->render('add', ['model' => $model,'cates'=>$cates]);
    }

    //删除
    public function actionDelete($id){
        if(GoodsCategory::findOne($id)->deleteWithChildren()){
            \yii::$app->session->setFlash("success","删除成功");
            return $this->redirect(['index']);
        }
    }

}

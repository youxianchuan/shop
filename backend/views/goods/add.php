<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */
/* @var $form ActiveForm */
?>
<div class="goods-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'sn') ?>
        <?= $form->field($model, 'goods_category_id')->dropDownList($cateArr) ?>
        <?= $form->field($model, 'brand_id')->dropDownList($brandArr) ?>
        <?= $form->field($model, 'market_price') ?>
        <?= $form->field($model, 'shop_price') ?>
        <?= $form->field($model, 'stock') ?>
        <?= $form->field($model, 'status')->radioList(yii::$app->params["status"]) ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'inputtime') ?>
    <?= $form->field($model, 'logo')->widget(\manks\FileInput::className(),['clientOptions' => [ 'server' => \yii\helpers\Url::to(['brand/upload'])]])?>
    <?php
    // ActiveForm
    echo $form->field($model, 'imagesFile')->widget('manks\FileInput', [
        'clientOptions' => [
            'pick' => [
                'multiple' => true,
            ],
             'server' => \yii\helpers\Url::to(['brand/upload']),
            // 'accept' => [
            // 	'extensions' => 'png',
            // ],
        ],
    ]); ?>
    <?=
    $form->field($intro, 'content')->widget(kucha\ueditor\UEditor::className(),[]) ?>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-add -->

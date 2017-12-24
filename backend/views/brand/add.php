<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\brand */
/* @var $form ActiveForm */
?>
<div class="brand-add">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($model, 'status')->radioList(yii::$app->params["status"]) ?>

        <?= $form->field($model, 'intro')->textarea() ?>

        <?= $form->field($model, 'imagesFile')->fileInput() ?>
        <?=\yii\bootstrap\Html::img("/$model->logo",['height'=>100])?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- brand-add -->

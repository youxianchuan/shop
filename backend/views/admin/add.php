<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form ActiveForm */
?>
<div class="admin-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password') ?>
        <?= $form->field($model, 'salt') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'token') ?>
        <?= $form->field($model, 'add_time') ?>
        <?= $form->field($model, 'last_login_time') ?>
        <?= $form->field($model, 'token_create_time') ?>
        <?= $form->field($model, 'last_login_ip') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- admin-add -->

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */
/* @var $form ActiveForm */
?>
<div class="site-login">

    <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'passworld')->passwordInput() ?>
    
        <div class="form-group">
            <?= Html::submitButton('登陆', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-login -->

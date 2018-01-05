<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */
/* @var $form ActiveForm */
?>
<div class="Permission-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['disabled'=>'disabled']) ?>
        <?= $form->field($model, 'description') ?>
        <?= $form->field($model, 'premissions')->checkboxList($presArr)?>

    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- Permission-add -->

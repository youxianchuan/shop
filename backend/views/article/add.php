<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Article */
/* @var $form ActiveForm */
?>
<div class="article-add">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'article_category_id')->dropDownList($cateArr) ?>
        <?= $form->field($model, 'intro') ?>
        <?= $form->field($model, 'status')->radioList(yii::$app->params["status"]) ?>
        <?= $form->field($model, 'sort') ?>
        <?= $form->field($detail, 'coment')->widget('kucha\ueditor\UEditor',[]) ?>

    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-add -->

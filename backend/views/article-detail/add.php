<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ArticleDetail */
/* @var $form ActiveForm */
?>
<div class="article-detail-add">

    <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'article_id') ?>
    <?= $form->field($model, 'coment') ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- article-detail-add -->

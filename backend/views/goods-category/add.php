<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\GoodsCategory */
/* @var $form ActiveForm */
?>
<div class="goods-category-add">
    <a href="index" class="btn-lg"><span class="glyphicon glyphicon-arrow-left "></span></a>
    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'parent_id')->hiddenInput(['value'=>0]) ?>
    <?= \liyuze\ztree\ZTree::widget([
        'setting' => '{
			data: {
				simpleData: {
					enable: true,
					pIdKey:"parent_id"
				},
			},
			callback:{
			       
			    onClick: function(e,treeId,treeNode){
			    //找到父类ID文本框
			    $("#goodscategory-parent_id").val(treeNode.id);
			    console.dir(treeNode.id);
			    },
		
			 }
			 			
		
		}',
        'nodes' =>$cates,

    ]);
    ?>
        <?= $form->field($model, 'intro') ?>
    
        <div class="form-group">
            <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- goods-category-add -->
<?php
$js=<<<qqq
var treeObj = $.fn.zTree.getZTreeObj("w1");
treeObj.expandAll(true);
qqq;

$this->registerJs($js);


?>

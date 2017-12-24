<h1 class="">品牌管理</h1>
<a href="add" class="btn btn-info">添加</a>
<table class="table">
    <tr>
        <td>ID</td>
        <td>品牌名</td>
        <td>分类</td>
        <td>状态</td>
        <td>分类</td>
        <td>logo</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->sort?></td>
        <td><?=yii::$app->params["status"]["$model->status"]?></td>
        <td><?=$model->intro?></td>
        <td><?=\yii\bootstrap\Html::img("/$model->logo",['height'=>50])?></td>
        <td><a href="edit?id=<?=$model->id?>" class="btn btn-primary">编辑</a><a href="del?id=<?=$model->id?>" class="btn btn-danger">删除</a></td>

    </tr>
    <?php endforeach;?>
</table>
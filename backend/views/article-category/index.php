<h1 class="">文章分类管理</h1>
<a href="add" class="btn btn-info">添加</a>
<table class="table">
    <tr>
        <td>ID</td>
        <td>名称</td>

        <td>简介</td>
        <td>状态</td>
        <td>排序</td>
        <td>操作</td>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->intro?></td>
            <td><?=yii::$app->params["status"]["$model->status"]?></td>
            <td><?=$model->sort?></td>

            <td><a href="edit?id=<?=$model->id?>" class="btn btn-primary">编辑</a><a href="del?id=<?=$model->id?>" class="btn btn-danger">删除</a></td>

        </tr>
    <?php endforeach;?>
</table>
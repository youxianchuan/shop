

<h1 class="">文章分类管理</h1>
<a href="add" class="btn btn-info">添加</a>
<div class="table-responsive">
<table class="table">
    <tr>
        <th>ID</th>
        <th>名称</th>

        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>操作</th>
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
   </div>
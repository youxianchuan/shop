<h1>文章管理</h1>
<a href="add" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a>
<table class="table">
    <tr>
        <th>ID</th>
        <th>文章名</th>
        <th>分类ID</th>
        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    <?php  foreach ($models as $model):?>
    <tr>

        <td><?=$model->id?></td>
        <td><?=$model->name?></td>
        <td><?=$model->category->name?></td>
        <td><?=$model->intro?></td>
        <td><?=Yii::$app->params["status"]["$model->status"]?></td>
        <td><?=$model->sort?></td>
        <td><?=$model->inputtime?></td>
        <td><a href="edit?id=<?=$model->id?>" class="btn btn-info"><span class="glyphicon glyphicon-edit"></span></a><a href="del?id=<?=$model->id?>" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>

    </tr>
    <?php endforeach;?>
</table>
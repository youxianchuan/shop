<a href="add" class="btn btn-primary">添加</a>
<div class="table-responsive">
<table class="table">
    <tr>
        <th>ID</th>
        <th>内容</th>
        <th>文章ID</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
    <tr>
        <td><?=$model->id?></td>
        <td><?=$model->coment?></td>
        <td><?=$model->article->name?></td>
        <td><a href="edit?id=<?=$model->id?>" class="btn btn-info">编辑</a><a href="del?id=<?=$model->id?>" class="btn btn-danger">删除</a></td>

    </tr>
    <?php endforeach;?>
</table>
</div>
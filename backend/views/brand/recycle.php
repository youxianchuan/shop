<h1 class="">品牌回收站管理</h1>
<a href="index" ><span class="glyphicon glyphicon-home btn-lg" style="font-size: 40px; color: #1b809e"></span></a>
<table class="table">
    <tr>
        <th>品牌名</th>
        <th>ID</th>
        <th>分类</th>
        <th>状态</th>
        <th>分类</th>
        <th>logo</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->sort?></td>
            <td><?=yii::$app->params["status"]["$model->status"]?></td>
            <td><?=$model->intro?></td>
            <td><?=\yii\bootstrap\Html::img("$model->logo",['height'=>50])?></td>
            <td><a href="edit?id=<?=$model->id?>" class="btn btn-primary">编辑</a><a href="del?id=<?=$model->id?>" class="btn btn-danger">删除</a></td>

        </tr>
    <?php endforeach;?>
</table>
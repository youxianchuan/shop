<h1 class="">商品管理</h1>
<a href="add" class="btn btn-info">添加</a>
<a href="recycle" class=""><span class="glyphicon glyphicon-trash"></span></a>
<table class="table">
    <tr>
         <th>ID</th>
        <th>商品名称</th>
        <th>货号</th>
        <th>库存</th>
        <th>分类</th>
        <th>品牌</th>
        <th>市场价格</th>
        <th>门店价格</th>
        <th>排序</th>
        <th>状态</th>
        <th>logo</th>
        <th>添加时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>
        <tr>
            <td><?=$model->id?></td>
            <td><?=$model->name?></td>
            <td><?=$model->sn?></td>
            <td><?=$model->stock?></td>
            <td><?=$model->goodsCategory->name?></td>
            <td><?=$model->brand->name?></td>
            <td><?=$model->market_price?></td>
            <td><?=$model->shop_price?></td>
            <td><?=$model->sort?></td>
            <td><?=yii::$app->params["status"]["$model->status"]?></td>
            <td><?=\yii\bootstrap\Html::img("$model->logo",['height'=>50])?></td>
            <td><?=$model->inputtime?></td>
            <td><a href=""></a><a href="edit?id=<?=$model->id?>" class="btn btn-primary">编辑</a><a href="del?id=<?=$model->id?>" class="btn btn-danger">删除</a></td>

        </tr>
    <?php endforeach;?>
</table>
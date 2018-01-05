<h1 class="">商品管理</h1>

<div class="row">
<div class="pull-left">

</div>
<div class="pull-right">
    <form class="form-inline">

            <select name="status" class="form-control">
                <option value="">请选择状态</option>
                <option  value ="2">禁用</option>
                <option  value ="1">启用</option>
            </select>

        <div class="form-group">
            <input type="text" size="3" class="form-control" name='minPrice' placeholder="最低价" value="<?=Yii::$app->request->get('minPrice')?>">
        </div>
        -
        <div class="form-group">
            <input type="text" size="3" class="form-control" name="maxPrice" placeholder="最高价" value="<?=Yii::$app->request->get('maxPrice')?>">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="keyword" placeholder="请输入名称或货号" value="<?=Yii::$app->request->get('keyword')?>">
        </div>
        <button type="submit" class="btn btn-default">搜索</button>
    </form>
</div>
</div>
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

<?=\yii\widgets\LinkPager::widget(
    ['pagination' => $pages]
)?>
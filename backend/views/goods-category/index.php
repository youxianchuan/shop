<?php

use leandrogehlen\treegrid\TreeGrid;


?>
<h1>商品分类管理</h1>


<?= TreeGrid::widget([
    'dataProvider' => $dataProvider,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_id',
    'parentRootValue' => '0', //first parentId value
    'pluginOptions' => [
        'initialState' => 'collapsed',
    ],
    'columns' => [
        'name',
        'id',
        'parent_id',
        'intro',
        ['class' => 'yii\grid\ActionColumn']
    ]
]); ?>
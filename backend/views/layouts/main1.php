<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top ',
        ],
    ]);
    $menuItems = [
        ['label' => '主页',
            'url' => ['/site/index'],
            'items'=>[
                [
                    'label'=>'Home1',
                    'url'=>'/site/index'
                ],
                [
                    'label'=>'Home2',
                    'url'=>'/site/index'
                ]
            ]

            ],
        ['label' => '品牌管理', 'url' => ['/brand/index']],
        ['label' => '文章管理',
            'url' => ['/article-category/index'],
             'items'=>[
                     ['label' => '文章分类管理', 'url' => ['/article-category/index'] ],
                        ['label' => '文章内容管理', 'url' => ['/article/index']],

            ],
            ],
        ['label' => '商品管理',
            'url' => ['/site/index'],
            'items'=>[
                [
                    'label'=>'商品分类管理',
                    'url'=>'/goods-category/index'
                ],
                [
                    'label'=>'商品管理',
                    'url'=>'/goods/index'
                ]
            ]

        ],

    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登陆', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>



</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

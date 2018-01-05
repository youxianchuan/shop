<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p> <?php
                    if(Yii::$app->user->isGuest){
                        echo "未登录！";
                    }else{
                        echo Yii::$app->user->identity->username;
                    }
                    ?></p>

                <a href="#"><i class="<?php
                    if(Yii::$app->user->isGuest){
                        echo "fa fa-circle text-danger";
                               }else{
                        echo "fa fa-circle text-success";
                    }
                    ?> "></i> Online</a>
            </div>
        </div>

<!--        <!-- search form -->-->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
<!--        <!-- /.search form -->-->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' =>mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id),
//                'items' => [
//                    ['label' => '欢迎来到后台界面', 'options' => ['class' => 'header']],
//                    [
//                        'label' => '品牌管理',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '品牌列表', 'icon' => 'file-code-o', 'url' => ['/brand/index'],],
//                            ['label' => '品牌添加', 'icon' => 'dashboard', 'url' => ['/brand/add'],],
//
//                        ],
//                    ],
//                    [
//                        'label' => '商品管理',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '商品列表', 'icon' => 'file-code-o', 'url' => ['/goods/index'],],
//                            ['label' => '商品添加', 'icon' => 'dashboard', 'url' => ['/goods/add'],],
//
//                        ],
//                    ],
//                    [
//                        'label' => '商品分类管理',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '商品分类列表', 'icon' => 'file-code-o', 'url' => ['/goods-category/index'],],
//                            ['label' => '商品分类添加', 'icon' => 'dashboard', 'url' => ['/goods-category/add'],],
//
//                        ],
//                    ],
//                    [
//                        'label' => '文章分类管理',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '文章分类列表', 'icon' => 'file-code-o', 'url' => ['/article-category/index'],],
//                            ['label' => '文章分类添加', 'icon' => 'dashboard', 'url' => ['/article-category/add'],],
//
//                        ],
//                    ],
//                    [
//                        'label' => '文章管理',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '文章列表', 'icon' => 'file-code-o', 'url' => ['/article/index'],],
//                            ['label' => '文章添加', 'icon' => 'dashboard', 'url' => ['/article/add'],],
//
//
//                        ],
//                    ],
//                    [
//                        'label' => '管理员管理',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '管理员列表', 'icon' => 'file-code-o', 'url' => ['/admin/index'],],
//                            ['label' => '管理员添加', 'icon' => 'dashboard', 'url' => ['/admin/add'],],
//
//
//                        ],
//                    ],
//                    [
//                        'label' => '权限管理',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '权限列表', 'icon' => 'file-code-o', 'url' => ['/permission/index'],],
//                            ['label' => '权限添加', 'icon' => 'dashboard', 'url' => ['/permission/add'],],
//
//                        ],
//                    ],
//                    [
//                        'label' => '角色权限管理',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => '角色列表', 'icon' => 'file-code-o', 'url' => ['/role/index'],],
//                            ['label' => '角色添加', 'icon' => 'dashboard', 'url' => ['/role/add'],],
//
//                        ],
//                    ],
//                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
//                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
//                    [
//                        'label' => 'Some tools',
//                        'icon' => 'share',
//                        'url' => '#',
//                        'items' => [
//                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
//                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
//                            [
//                                'label' => 'Level One',
//                                'icon' => 'circle-o',
//                                'url' => '#',
//                                'items' => [
//                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
//                                    [
//                                        'label' => 'Level Two',
//                                        'icon' => 'circle-o',
//                                        'url' => '#',
//                                        'items' => [
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
//                                        ],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
//                ],
            ]
        ) ?>

    </section>

</aside>

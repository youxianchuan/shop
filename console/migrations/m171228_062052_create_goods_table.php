<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods`.
 */
class m171228_062052_create_goods_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment("商品名称"),
            'sn'=>$this->string()->notNull()->comment("商品名称"),
            'logo'=>$this->string()->notNull()->comment("商品LOGO"),
            'goods_category_id'=>$this->integer()->notNull()->comment("商品分类ID"),
            'brand_id'=>$this->integer()->notNull()->comment("品牌ID"),
            'market_price'=>$this->decimal()->notNull()->comment("市场价格"),
            'shop_price'=>$this->decimal()->notNull()->comment("本店价格"),
            'stock'=>$this->integer()->notNull()->comment("库存"),
            'status'=>$this->integer()->notNull()->comment("状态"),
            'sort'=>$this->integer()->notNull()->comment("排序"),
            'inputtime'=>$this->integer()->notNull()->comment("录入时间"),

        ]);

        $this->createTable('goods_intro', [
            'id' => $this->primaryKey(),
            'content'=>$this->text()->comment("商品描述"),
            'goods_id'=>$this->integer()->notNull()->comment("商品ID"),


        ]);

        $this->createTable('goods_gallery', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->notNull()->comment("商品ID"),
            'path'=>$this->string()->notNull()->comment("图片地址")


        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods');
    }
}

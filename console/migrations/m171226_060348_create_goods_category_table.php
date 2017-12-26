<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m171226_060348_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment("分类名称"),
            'intro'=>$this->string()->comment("简介"),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'depth' => $this->integer()->notNull()->comment("层次"),
            'tree'=>$this->integer()->notNull()->comment("树"),
            'parent_id'=>$this->integer()->notNull()->comment("父类ID")
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}

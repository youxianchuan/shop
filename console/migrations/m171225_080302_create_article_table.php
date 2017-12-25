<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article`.
 */
class m171225_080302_create_article_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article', [
            'id' => $this->primaryKey(),
            'name'=>$this->string()->notNull()->comment("文章名"),
            'article_category_id'=>$this->integer()->notNull()->comment("所属分类"),
            'intro'=>$this->text()->notNull()->comment("简介"),
            'status'=>$this->integer()->notNull()->comment("状态"),
            'sort'=>$this->integer()->notNull()->comment("排序"),
            'inputtime'=>$this->integer()->notNull()->comment("录入时间")

        ]);
        $this->createTable('article_detail', [
            'id' => $this->primaryKey(),
           'coment'=>$this->text()->comment("内容"),
            'article_id'=>$this->integer()->notNull()->comment("文章id")


        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article');
    }
}

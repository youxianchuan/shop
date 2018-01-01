<?php

use yii\db\Migration;

/**
 * Handles the creation of table `admin`.
 */
class m171231_104835_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username'=>$this->string()->notNull()->comment("用户名"),
            'password'=>$this->string()->notNull()->comment("密码"),
            'salt'=>$this->string()->notNull()->comment("盐"),
            'email'=>$this->string()->notNull()->comment("邮箱"),
            'token'=>$this->string()->notNull()->comment("自动登陆令牌"),
            'token_create_time'=>$this->string()->comment("令牌创建时间"),
            'add_time'=>$this->integer()->notNull()->comment("注册时间"),
            'last_login_time'=>$this->integer()->notNull()->comment("最后登陆时间"),
            'last_login_ip'=>$this->string()->comment("登陆ip"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('admin');
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property integer $id
 * @property string $username
 * @property string $passworld
 * @property integer $age
 * @property string $sex
 * @property string $img
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['username', 'passworld'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'passworld' => '密码'

        ];
    }
}

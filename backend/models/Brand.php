<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property string $logo
 * @property integer $sort
 * @property integer $status
 */
class Brand extends \yii\db\ActiveRecord
{
    public $imagesFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort', 'status'], 'integer'],
            [['name', 'intro', 'logo'], 'required'],
           // [['imagesFile'],'file','skipOnEmpty' => false,'extensions' => 'jpg,img,png,gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '品牌名字',
            'intro' => '简介',
            'imagesFile' => '图标',
            'sort' => '分类',
            'status' => '状态',
        ];
    }
}

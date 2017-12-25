<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $article_category_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'article_category_id', 'intro', 'status', 'sort' ], 'required'],
            [['article_category_id', 'status', 'sort'], 'integer'],
            [['intro'], 'string'],
            [['name'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章名',
            'article_category_id' => '所属分类',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '录入时间',

        ];
    }

    public function getCategory(){
        return $this->hasOne(ArticleCategory::className(),['id'=>'article_category_id']);
    }
}

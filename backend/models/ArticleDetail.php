<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_detail".
 *
 * @property integer $id
 * @property string $coment
 * @property integer $article_id
 */
class ArticleDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coment'], 'string'],
            [['article_id'], 'required'],
            [['article_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coment' => '内容',
            'article_id' => '文章id',
        ];
    }

    public function getArticle(){
        return $this->hasOne(Article::className(),['id'=>'article_id']);
    }
}

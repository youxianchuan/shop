<?php

namespace backend\models;
use backend\models\MenuQuery;
use creocoder\nestedsets\NestedSetsBehavior;
use Symfony\Component\CssSelector\Node\NegationNode;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property integer $tree
 * @property integer $parent_id
 */
class GoodsCategory extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'parent_id'], 'required'],

            [['name', 'intro'], 'string'],
            [['parent_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名称',
            'intro' => '简介',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => '层次',
            'tree' => '树',
            'parent_id' => '父类ID',
        ];
    }


    public function behaviors() {
        return [
            'tree' => [

                'class' => NestedSetsBehavior::className(),

               'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    /**
     * @return MenuQuery
     */
    public static function find()
    {
        return new MenuQuery(get_called_class());

    }


}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "goods".
 *
 * @property integer $id
 * @property string $name
 * @property string $sn
 * @property string $logo
 * @property integer $goods_category_id
 * @property integer $brand_id
 * @property string $market_price
 * @property string $shop_price
 * @property integer $stock
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Goods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'sn', 'logo', 'goods_category_id', 'brand_id', 'market_price', 'shop_price', 'stock', 'status', 'sort', 'inputtime'], 'required'],
            [['goods_category_id', 'brand_id', 'stock', 'status', 'sort', 'inputtime'], 'integer'],
            [['market_price', 'shop_price'], 'number'],
            [['name', 'sn', 'logo'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商品名称',
            'sn' => '货号',
            'logo' => '商品LOGO',
            'goods_category_id' => '商品分类ID',
            'brand_id' => '品牌ID',
            'market_price' => '市场价格',
            'shop_price' => '本店价格',
            'stock' => '库存',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => '录入时间',
        ];
    }

    //得到商品分类显示到试图
    public function getGoodsCategory(){
        return $this->hasOne(GoodsCategory::className(),['id'=>'goods_category_id']);
    }

    //得到品牌分类显示到试图
    public function getBrand(){
        return $this->hasOne(Brand::className(),['id'=>'brand_id']);
    }
}

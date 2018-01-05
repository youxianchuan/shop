<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "liebiao".
 *
 * @property integer $Id
 * @property string $name
 * @property string $url
 * @property string $icon
 * @property integer $parent_id
 */
class LieBiao extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'liebiao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['name', 'url', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'name' => 'Name',
            'url' => 'Url',
            'icon' => 'Icon',
            'parent_id' => 'Parent ID',
        ];
    }

    public static function liebiao(){

        $newMenus = [];
        //只找出一一级分类
        $menus = self::find()->where(['parent_id' => 0])->all();

        //循环一级分类
        foreach ($menus as $menu) {
            //分别赋值
            $newMenu = [
                'label' => $menu->name,
                'icon' => $menu->icon,
                'url' => '#',
            ];
            //循环当前分类的二级分类

            foreach (self::find()->where(['parent_id' => $menu->id])->all() as $v) {
                //给每个二级分类赋值
                $newMenu['items'][] = [
                    'label' => $v->name,
                    'icon' => $v->icon,
                    'url' => [$v->url]
                ];
            }
            //把一级分类追加到数组中
            $newMenus[]=$newMenu;
        }
        //返回
        return $newMenus;
        // return self::find()->all();

    }
}

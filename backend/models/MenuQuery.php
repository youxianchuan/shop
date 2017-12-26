<?php
/**
 * Created by PhpStorm.
 * User: 游贤川
 * Date: 2017/12/26
 * Time: 14:31
 */

namespace backend\models;

use creocoder\nestedsets\NestedSetsQueryBehavior;

class MenuQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}
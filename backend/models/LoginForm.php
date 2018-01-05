<?php
/**
 * Created by PhpStorm.
 * User: 游贤川
 * Date: 2018/1/1
 * Time: 20:54
 */

namespace backend\models;


use yii\base\Model;

class LoginForm extends Model
{
public $username;
public $password;
public $rememberMe=true;

public function rules()
{
    return [

      [['username','password'],'required'],
      [['rememberMe'],'safe']
    ];
}
public function attributeLabels()
{
    return [
      'username'=>"用户名",
      'password'=>"密码"

    ];
}
}
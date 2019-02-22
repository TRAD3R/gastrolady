<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 21:02
 */

namespace app\models;


use yii\base\Model;

class UserLoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6]
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => \Yii::t('app', 'email'),
            'password' => \Yii::t('app', 'password'),
            'rememberMe' => \Yii::t('app', 'rememberMe')
        ];
    }
}
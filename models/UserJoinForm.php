<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 19:42
 */

namespace app\models;


use yii\base\Model;

class UserJoinForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $passwordRepeat;

    public function rules(){
        return [
            [['username', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['email', 'uniqueEmail'],
            ['password', 'string', 'min' => 6],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function uniqueEmail(){
        if(!$this->hasErrors()){
            if(User::findOne(['email' => $this->email])){
                $this->addError('email', \Yii::t('app', 'The email issets in DB'));
            }
        }
    }

    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('app', 'username'),
            'email' => \Yii::t('app', 'email'),
            'password' => \Yii::t('app', 'password'),
            'passwordRepeat' => \Yii::t('app', 'passwordRepeat'),
        ];
    }
}
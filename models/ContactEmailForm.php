<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 08.01.19
 * Time: 16:42
 */

namespace app\models;


use Yii;
use yii\base\Model;

class ContactEmailForm extends Model
{
    public $username;
    public $email;
    public $text;
    public $recaptcha;

    public function rules()
    {
        return [
            [['username', 'email', 'text', 'recaptcha'], 'required'],
            ['email', 'email'],
            ['recaptcha', 'isNotRobot']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'username'),
            'email' => Yii::t('app', 'email'),
            'text' => Yii::t('app', 'contact text'),
        ];
    }

    public function isNotRobot(){
        if(!$this->getErrors()){
            $secret = '6LfPPYkUAAAAAM5KSe6PdRoMNVlV0J5gzbrk67WA';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$this->recaptcha);
            $responseData = json_decode($verifyResponse);
            if(!$responseData->success){
                return $this->addError('email', Yii::t('app', "You are a bot"));
            }
        }
    }
}
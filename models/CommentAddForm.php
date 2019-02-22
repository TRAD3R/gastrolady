<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 04.01.19
 * Time: 10:49
 */

namespace app\models;


use yii\base\Model;

class CommentAddForm extends Model
{
    public $username;
    public $email;
    public $comment;
    public $article_id;
    public $parent;

    public function rules()
    {
        return [
            [['username', 'email', 'comment', 'article_id', 'parent'], 'required'],
            ['email', 'email'],
            ['article_id', 'integer'],
            ['parent', 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => \Yii::t('app', 'username'),
            'email' => \Yii::t('app', 'email'),
            'comment' => \Yii::t('app', 'comment'),
        ];
    }
}
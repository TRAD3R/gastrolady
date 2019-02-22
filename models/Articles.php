<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 18:40
 */

namespace app\models;


use yii\db\ActiveRecord;

class Articles extends ActiveRecord
{
    public static function tableName()
    {
        return "trd_articles";
    }

    public function getAuthor(){
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    public function getMeta(){
        return $this->hasOne(ArticleMeta::class, ['article_id' => 'id']);
    }

    public function getComments(){
        return $this->hasMany(Comment::class, ['article_id' => 'id']);
    }
}
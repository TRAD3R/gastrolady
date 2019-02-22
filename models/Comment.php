<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 03.01.19
 * Time: 20:45
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
    public static function tableName()
    {
        return "trd_comments";
    }

    public function getArticle(){
        return $this->hasOne(Articles::class, ['id' => 'article_id']);
    }

    public static function findByArticle($article_id){
        $comments = static::find()
            ->where(['article_id' => $article_id])
            ->all();

        $tmpComments = [];
        foreach ($comments as $comment){
            if($comment->parent === 0){
                $tmpComments[$comment->id]['main'] = $comment;
            }else{
                $tmpComments[$comment->parent]['children'][] = $comment;
            }
        }

        return $tmpComments;
    }

    public static function getCommentsTitle($comments){
        if($comments) {
            $commentsTitle = count($comments);
            $lastNumbers = count($comments) % 100;
            if ($lastNumbers > 20 || count($comments) < 5) {
                $lastNumbers = $lastNumbers % 10;
                $commentsTitle .= $lastNumbers == 1 ? " " . Yii::t('app', 'comment') : " " . Yii::t('app', 'comments');
            } else {
                $commentsTitle .= " " . Yii::t('app', 'comments2');
            }
        }else{
            $commentsTitle = Yii::t('app', 'no comments');
        }

        return $commentsTitle;
    }
}
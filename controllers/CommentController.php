<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 04.01.19
 * Time: 11:33
 */

namespace app\controllers;


use app\models\Comment;
use app\models\CommentAddForm;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

class CommentController extends Controller
{
    public function actionSave(){
        $commentAddForm = new CommentAddForm();

        if(\Yii::$app->request->isAjax){
            $commentAddForm->load(Yii::$app->request->post());
            if(!Yii::$app->user->isGuest){
                $commentAddForm->username = Yii::$app->user->identity->username;
                $commentAddForm->email = Yii::$app->user->identity->email;
            }
            if($commentAddForm->validate()){
                $comment = new Comment();
                $comment->username = $commentAddForm->username;
                $comment->email = $commentAddForm->email;
                $comment->comment = $commentAddForm->comment;
                $comment->article_id = $commentAddForm->article_id;
                $comment->parent = $commentAddForm->parent;
                $comment->created = time();

                if($comment->save()){
                    $comments = Comment::findByArticle($comment->article_id);
                    $commentsTitle = Comment::getCommentsTitle($comments);

                    return json_encode([
                        'comments' => $comments,
                        'commentsTitle' => $commentsTitle
                    ]);
                }
                return "save error";
            }
            return "validate error";
        }

        return null;
    } // actionSave
}
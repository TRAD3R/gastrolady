<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 17:37
 */

namespace app\controllers;


use app\models\ArticleMeta;
use app\models\Articles;
use app\models\Comment;
use app\models\CommentAddForm;
use app\models\ReviewAddForm;
use app\models\ReviewEditForm;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class ReviewController extends Controller
{
    public function actionList(){
        $articles = Articles::find()->with('meta')->all();

        return $this->render('list', [
            "articles" => $articles
        ]);
    } // actionArticles

    public function actionAdd(){
        $reviewAddForm = new ReviewAddForm();

        if(Yii::$app->request->isPost){
            if($reviewAddForm->load(Yii::$app->request->post())) {
                $reviewAddForm->mainImage = UploadedFile::getInstance($reviewAddForm, 'mainImage');
                $reviewAddForm->gallery = UploadedFile::getInstances($reviewAddForm, 'gallery');

                if ($reviewAddForm->validate() && $reviewAddForm->upload()) {
                    $article = new Articles();
                    $article->author_id = Yii::$app->user->getId();
                    $created = time();
                    $article->created = $article->updated = $created;
                    if ($article->save()) {
                        $articleMeta = new ArticleMeta();
                        $articleMeta->article_id = $article->id;
                        $articleMeta->lang = Yii::$app->language;
                        if(empty($reviewAddForm->title)){
                            $articleMeta->title = "";
                            $articleMeta->url = date("Y-m-d-H-i", time());
                        }else{
                            $articleMeta->title = $reviewAddForm->title;
                            $articleMeta->createUrl();
                        }
                        $articleMeta->content = $reviewAddForm->content;
                        $articleMeta->main_image = $reviewAddForm->mainImage;
                        $articleMeta->gallery = $reviewAddForm->gallery;

                        if ($articleMeta->save())
                            return $this->redirect("/reviews");

                    }
                }
            }
        }

        return $this->render('add', [
            'reviewAddForm' => $reviewAddForm
        ]);
    } // actionAdd

    public function actionView(){
        $url = explode("/", Yii::$app->request->pathInfo);
        $article = ArticleMeta::findByUrl($url[count($url) - 1]);
        $prevArticle = ArticleMeta::getPrevArticle($article->id);
        $nextArticle = ArticleMeta::getNextArticle($article->id);


        $comments = Comment::findByArticle($article->article_id);
        $commentsTitle = Comment::getCommentsTitle($comments);

        $commentAddForm = new CommentAddForm();
        $commentAddForm->article_id = $article->article_id;
        $commentAddForm->parent = 0;

        return $this->render('view', [
            'prevArticle' => $prevArticle,
            'nextArticle' => $nextArticle,
            'article' => $article,
            'commentsTitle' => $commentsTitle,
            'comments' => $comments,
            'commentAddForm' => $commentAddForm,
        ]);
    } // actionView

    public function actionEdit(){
        $id = (int) Yii::$app->request->get('id');
        $articleMeta = ArticleMeta::findOne(['article_id' => $id, 'lang' => Yii::$app->language]);

        $reviewEditForm = new ReviewEditForm();

        $reviewEditForm->title = $articleMeta->title;
        $reviewEditForm->content = $articleMeta->content;
        $reviewEditForm->mainImage = $articleMeta->main_image;
        $reviewEditForm->gallery = $articleMeta->gallery;

        if(Yii::$app->request->isPost){
            if($reviewEditForm->load(Yii::$app->request->post())) {
                $reviewEditForm->mainImage = UploadedFile::getInstance($reviewEditForm, 'mainImage');
                $reviewEditForm->gallery = UploadedFile::getInstances($reviewEditForm, 'gallery');

                if ($reviewEditForm->validate() && $reviewEditForm->upload()) {
                    if($articleMeta->title != $reviewEditForm->title) {
                        $articleMeta->title = $reviewEditForm->title;
                        $articleMeta->createUrl();
                    }
                    $articleMeta->content = $reviewEditForm->content;
                    if($reviewEditForm->mainImage) $articleMeta->main_image = $reviewEditForm->mainImage;
                    if(!empty($reviewEditForm->gallery)) $articleMeta->gallery = $reviewEditForm->gallery;

                    if ($articleMeta->save()){
                        $article = Articles::findOne($id);
                        $article->updated = time();
                        if ($article->save()) {
                            return $this->redirect("/reviews");
                        }
                    }
                }
            }
        }


        return $this->render('edit', [
            'reviewEditForm' => $reviewEditForm
        ]);
    } // actionEdit
}
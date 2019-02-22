<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 03.01.19
 * Time: 11:34
 */

/* @var $this \yii\web\View */
/* @var $articles \yii\db\ActiveQuery */


use yii\helpers\Html;
use yii\helpers\StringHelper;
$this->title = Yii::t('app', 'reviews');
?>

<!-- Our Blog Section -->
<section id="blog">
    <div class="blog-section section-padding">
        <div class="section-title-container">
            <h2 class="section-title"><?=Yii::t('app', 'reviews')?></h2>
        </div><!-- /.section-title-container -->

        <div class="blog-post-container">
            <div class="row">
                <?php foreach ($articles as $article): ?>
                <div class="col-sm-6">
                    <article class="post-content wow fadeIn" data-wow-delay=".1s">
                        <?php if(!Yii::$app->user->isGuest && Yii::$app->user->identity->status == 1):?>
                        <div class="post-meta">
                            <div class="entry-meta">
                                <div class="entry-date">
                                    <span class="date"><?=date("d", $article['created'])?></span>
                                    <span class="month"><?=date("M", $article['created'])?></span>
                                    <span class="year"><?=date("Y", $article['created'])?></span>
                                </div>
                            </div><!-- /.entry-meta -->
                            <div>
                                <br>
                                <?=Html::a(Yii::t('app', 'edit'), '/review/edit/'.$article['id'], ['class' => 'badge badge-warning'])?>
                            </div>
                        </div><!-- /.post-meta -->
                        <?php endif;?>
                        <div class="featured-img">
                            <img class="blog-post-image" src="/images/reviews/<?=$article['meta']['main_image']?>" alt="<?=$article['meta']['title']?>">
                            <a href="/images/reviews/<?=$article['meta']['main_image']?>" class="boxer img-link"></a>
                        </div><!-- /.featured-img -->
                        <div class="post-container">
                            <h2 class="post-title">
                                <?=\yii\helpers\Html::a($article['meta']['title'], ['/review/' . $article['meta']['url']])?>
                            </h2><!-- /.post-title -->
                            <div class="post-description">
                                <?=StringHelper::truncateWords($article['meta']['content'], 10)?>
                            </div>
                            <div class="continue-reading pull-left">
                                <a href="<?=\yii\helpers\Url::to('/review/' . $article['meta']['url'])?>"><?=Yii::t('app', 'read more')?><i class="fa fa-angle-double-right"></i>  </a>
                            </div><!-- /.continue-reading -->
                        </div><!-- /.post-container -->
                    </article><!-- /.post-content -->
                </div><!-- /.col-sm-6 -->
                <?php endforeach;?>
            </div><!-- /.row -->
        </div><!-- /.blog-post-container -->
    </div><!-- /.blog -->
</section><!-- /#blog -->
<!-- Our Blog Section End -->


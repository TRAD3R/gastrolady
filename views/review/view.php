<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 03.01.19
 * Time: 15:10
 */

/* @var $this \yii\web\View */
/* @var $article \app\models\ArticleMeta|array|null|\yii\db\ActiveRecord */
/* @var $prevArticle \app\models\ArticleMeta|array|null|\yii\db\ActiveRecord */
/* @var $nextArticle \app\models\ArticleMeta|array|null|\yii\db\ActiveRecord */
/* @var $commentsTitle string */
/* @var $comments array|null */
/* @var $commentAddForm \app\models\CommentAddForm */

$this->title = $article->title;

use app\assets\Mdate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<!-- Our Blog Section -->
				<section id="blog">
					<div class="blog-section section-padding single-page">
						<div class="blog-post-container">
							<article class="post type-post">
                                <div id="gallery">
                                    <div id="panel">
                                        <img id="largeImage" src="/images/reviews/<?=$article->main_image?>" />
                                    </div>
                                    <div id="thumbs">
                                        <img src="/images/reviews/<?=$article->main_image?>" alt="<?=$this->title?>" />
                                        <?php $gallery = explode(",", $article->gallery);
                                            foreach ($gallery as $image):
                                        ?>
                                            <img src="/images/reviews/<?=$image?>" alt="<?=$this->title?>" />
                                        <?php endforeach;?>
                                    </div>
                                </div>
								<div class="post-content">
									<h2 class="post-title">
                                        <?=$this->title?>
									</h2>
									<div class="entry">
										<?=$article->content?>
									</div><!-- /.entry -->
								</div><!-- /.post-content -->
							</article><!-- /.post-content -->

							<nav class="navigation post-navigation" role="navigation">
								<div class="nav-links">
                                    <?php if($prevArticle):?>
									<a href="<?=$prevArticle['url']?>" class="prev" rel="prev">
										<span class="meta-nav"><?=Yii::t('app', 'Previous review')?></span>
										<span class="nav-icon"><i class="fa fa-angle-double-left"></i></span>
                                        <?=mb_substr($prevArticle['title'], 0, 30)?> ...
									</a>
                                    <?php endif ?>
                                    <?php if($nextArticle):?>
									<a href="<?=$nextArticle['url']?>" class="next" rel="next">
										<span class="meta-nav"><?=Yii::t('app', 'Next review')?></span>
										<span class="nav-icon"><i class="fa fa-angle-double-right"></i></span>
                                        <?=mb_substr($nextArticle['title'], 0, 30)?> ...
									</a>
                                    <?php endif ?>
								</div><!-- .nav-links -->
							</nav><!-- /.post-navigation -->

							<div id="comments" class="comments-area">
								<h3 class="comments-title"><?=$commentsTitle?></h3>
                                <!-- /.comments-title -->
                                <?php if($comments):?>
								<ol class="comment-list">
                                    <?php foreach ($comments as $comment): ?>
									<li class="comment parent" id="comment-id-<?=$comment['main']->id?>">
										<article class="comment-body">
											<div class="comment-metadata">
												<h5 class="comment-author">
													<?=$comment['main']->username?>
												</h5><!-- /.comment-author -->
                                                <time>
                                                    <?=Mdate::show_shot_date($comment['main']->created)?>
                                                </time>
												<span class="reply pull-right">
													<a class="comment-reply-link" href="#comment-add-form"><?=Yii::t('app', 'Reply')?></a>
												</span><!-- /.reply -->
											</div><!-- /.comment-metadata -->

											<div class="comment-content">
												<?=$comment['main']->comment?>
											</div><!-- .comment-content -->
										</article><!-- /.comment-body -->
                                        <?php if(isset($comment['children'])): ?>
										<ol class="children">
                                            <?php foreach ($comment['children'] as $child): ?>
											<li class="comment">
												<article class="comment-body">
													<div class="comment-metadata">
														<h5 class="comment-author">
                                                            <?=$child->username?>
														</h5><!-- /.comment-author -->
															<time>
                                                                <?=Mdate::show_shot_date($child->created)?>
                                                            </time>
													</div><!-- /.comment-metadata -->

													<div class="comment-content">
                                                        <?=$child->comment?>
													</div><!-- .comment-content -->

												</article><!-- /.comment-body -->
											</li><!-- /.comment -->
                                            <?php endforeach ?>
										</ol><!-- /.children -->
                                        <?php endif; ?>
									</li><!-- /.comment -->
                                    <?php endforeach; ?>
								</ol><!-- /.comment-list -->
                                <?php endif;?>



								<div id="respond" class="comment-respond">
									<h4 id="reply-title" class="comment-reply-title"><?=Yii::t('app', 'Leave a reply')?></h4>
                                    <!-- /#reply-title -->
                                    <?php $form = ActiveForm::begin([
                                            'id' => 'comment-add-form',
                                            'class' => 'comment-form'
                                    ]) ?>

                                    <?php if(Yii::$app->user->isGuest):?>
                                        <?=$form->field($commentAddForm, 'username')->textInput()?>
                                        <?=$form->field($commentAddForm, 'email')->input('email')?>
                                    <?php endif?>

                                    <?=$form->field($commentAddForm, 'comment')->textarea()?>
                                    <?=Html::activeHiddenInput($commentAddForm, 'article_id')?>
                                    <?=Html::activeHiddenInput($commentAddForm, 'parent')?>
                                    <?=Html::submitButton(Yii::t('app', 'button_send'))?>
                                    <?php ActiveForm::end()?><!-- /#commentform -->
								</div><!-- /#respond -->


							</div><!-- /#comments -->


						</div><!-- /.blog-post-container -->
					</div><!-- /.blog -->
				</section><!-- /#blog -->
				<!-- Our Blog Section End -->
<?php
$js = <<<JS
    var form = document.querySelector("#comment-add-form");
    $('#comment-add-form').on('beforeSubmit', function(){
        var data = $(this).serialize();
        $.ajax({
            url: '/comment/save',
            type: 'POST',
            data: data,
            success: function(res){
                location.href = location.origin + location.pathname;
            },
            error: function(res){
                alert('Error!');
                console.log(res);
            }
        });
        return false;
    });
    
    var btnReplies = document.querySelectorAll(".comment-reply-link");
    btnReplies.forEach(btn => {
        btn.addEventListener('click', function(event) {
            let parent = event.target.parentNode.parentNode.parentNode.parentNode.id;
            let parent_id = parent.match(/\d+/);
          document.querySelector("#commentaddform-parent").value = parent_id;
        })
    })
JS;

$this->registerJs($js);
?>
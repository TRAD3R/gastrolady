<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 19:24
 */

/* @var $this \yii\web\View */
/* @var $articles \yii\db\ActiveQuery */

$this->title = Yii::t('app', "reviews");
$this->params['breadcrumbs'][] = $this->title;

?>
<!-- Our Blog Section -->
<section id="event">
    <div class="event-section section-padding">
        <div class="section-title-container">
            <h2 class="section-title"><?=Yii::t('app', 'reviews')?></h2>
        </div><!-- /.section-title-container -->

        <div class="event-container">
            <div class="row">

                <div class="col-sm-6">
                    <div class="event-item wow fadeIn animated" data-wow-delay="0.1s">
                        <div class="event-img">
                            <img src="images//event-1.jpg" alt="Event 1">
                        </div><!-- /.event-img -->
                        <div class="event-time">
                            <span class="event-month">September</span>
                            <span class="event-date">23</span>
                            <span class="event-year">2014</span>
                        </div><!-- /.event-time -->
                        <h3 class="event-title">Valentine's Day Special</h3>
                        <div class="event-place">
                            <strong>Place:</strong>1612 Collins Street West, Victoria 8007 Australia.
                        </div>
                        <div class="event-time-h"><strong>Time:</strong>7:30pm </div>
                    </div><!-- /.event-item -->
                </div>


            </div><!-- /.row -->
        </div><!-- /.event-container -->
    </div><!-- /.event-section -->
</section><!-- /#event -->
<!-- Our Blog Section End -->


<div class="pagination">
    <nav class="paging-navigation">
        <a href="#" class="page-numbers active">1</a>
        <a href="#" class="page-numbers">2</a>
        <a href="#" class="page-numbers">3</a>
        <a href="#" class="page-numbers">»</a>
    </nav>
</div><!-- /.pagination -->
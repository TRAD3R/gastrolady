<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 17:08
 */

/* @var $this \yii\web\View */
?>

<section id="error-page" class="section-padding error-page">

    <div class="section-title-container">
        <h2 class="section-title"><?=Yii::t('app', '404 Error')?></h2>
    </div><!-- /.section-title-container -->




    <!-- 404 Page -->
    <div class="page-not-found">
        <div class="error-icon">
            <span class="icon-eye left"></span>
            <span class="icon-eye right"></span>
            <span class="icon-lip"></span>
        </div><!-- /.error-icon -->


        <h2><?=Yii::t('app', 'page not found')?></h2>
        <p>
            <?=Yii::t('app', 'The page you are looking for is not available here. Please navigate to the other page!')?>
        </p>
    </div><!-- /.page-not-found -->
    <!-- 404 Page End -->






</section><!-- /#error-box -->


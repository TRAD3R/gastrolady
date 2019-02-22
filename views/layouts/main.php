<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 15:21
 */

/** @var $this \yii\web\View */
/** @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$this->title?></title>
    <?php $this->head(); ?>
    <script src='https://www.google.com/recaptcha/api.js?render=6LfPPYkUAAAAALNqTTyKoCIwm1WiH6ndJhWdwOqW'></script>
</head>
<body class="home">
<?php $this->beginBody()?>

    <!-- Menu -->
    <div class="navbar-fixed-top main-menu-continer">
        <!-- Responsive Navigation -->
        <button type="button" class="btn menubar-toggle">
            <i class="fa fa-bars"></i>
        </button> <!-- /.navbar-toggle -->

        <div id="main-menu" class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Logo -->
                <a class="navbar-brand" href="/">
                    <img src="/images/logo.png" alt="<?=Yii::$app->name?>">
                </a><!-- /.navbar-brand -->
            </div> <!-- /.navbar-header -->

            <nav class="navbar-collapse clearfix" role="navigation">
                <!-- Main navigation -->
                <ul id="headernavigation" class="nav navbar-nav">
                    <li><?=Html::a(Yii::t('app', 'reviews'), '/reviews')?></li>
                    <li><?=Html::a(Yii::t('app', 'contact'), '/contact')?></li>
                    <li><?=Html::a(Yii::t('app', 'About'), '/main/about')?></li>
                    <?php if(Yii::$app->user->isGuest):?>
                        <li><?=Html::a(Yii::t('app', 'Login'), '/user/login')?></li>
                        <li><?=Html::a(Yii::t('app', 'Join'), '/user/join')?></li>
                    <?php else:?>
                        <li><?=Html::a(Yii::t('app', 'new review'), '/review/add')?></li>
                        <li><?=Html::a(Yii::t('app', 'Logout'), '/user/logout')?></li>
                    <?php endif;?>
                </ul> <!-- /.nav .navbar-nav -->
            </nav> <!-- /.navbar-collapse  -->

            <div class="nav-social-btn">
                <a href="https://vk.com/gastro_lady" class="vk-btn" target="_blank"><i class="fa fa-vk"></i></a>
            </div><!-- /.nav-social-btn -->
        </div><!-- /#main-menu -->

    </div><!-- /.main-menu-continer -->
    <!-- Menu End -->
    <div class="container">
        <div class="row">
            <!-- Main Container -->
            <div id="main-container"  class="main-container pull-right" >
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?php if (!empty(Yii::$app->session->getAllFlashes())):?>
                    <?php foreach(Yii::$app->session->getAllFlashes() as $type => $message): ?>
                        <div class="alert alert-<?= $type ?>" role="alert"><?= $message ?></div>
                    <?php endforeach ?>
                <?php endif;?>
            <?=$content?>

            </div><!-- /#main-container -->
            <!-- Main Container End -->
            <!-- Side Bar -->
            <div id="left-sidebar" class="left-sidebar pull-left">
                <!-- do not delete this  -->
            </div>
            <!-- /#left-sidebar -->
            <!-- Side Bar End -->
            <div id="scroll-to-top" class="right-fix-btn">
                <div class="go-to-top">
                    <i class="fa fa-angle-double-up"></i>
                </div><!-- /.go-to-top -->
            </div><!-- /#scroll-to-top -->

            <!-- Footer Section -->
            <footer id="footer-section" class="main-container pull-right">
                <div class="copyrights ">
                    &copy; 2019 <?=Html::a(strtoupper(Yii::$app->name), ["/"])?><span class="v-line"></span> Dessigned by <a href="https://jeweltheme.com">Jewel Theme</a>
                </div><!-- /.copyrights -->
            </footer><!-- /#footer-section -->
            <!-- Footer Section End -->
        </div><!-- /.row -->
    </div><!-- /.container -->
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage();

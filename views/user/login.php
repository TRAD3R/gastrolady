<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 21:02
 */

/* @var $this \yii\web\View */
/** @var $userLoginForm \app\models\UserLoginForm */

$this->title = Yii::t('app', 'Login');

use yii\bootstrap\ActiveForm;use yii\helpers\Html; ?>

<!-- Book Table -->
<section id="book-table" class="parallax-style">
    <div class="book-table overlay-light section-padding">
        <div class="section-title-container">
            <h2 class="section-title"><?=$this->title?></h2>
        </div><!-- /.section-title-container -->

        <div class="choose-table user-login">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'choose-table-form'
                ]
            ])?>

            <div class="col-sm-6 form-item">
                <?=$form->field($userLoginForm, 'email')->input('email', ['class' => 'form-control'])?><br>
            </div><!-- /.form-item -->

            <div class="col-sm-6 form-item">
                <?=$form->field($userLoginForm, 'password')->passwordInput(['class' => 'form-control'])?><br>
            </div><!-- /.form-item -->
            <div class="col-sm-6 form-item">
                <?=$form->field($userLoginForm, 'rememberMe')->checkbox()?><br>
            </div><!-- /.form-item -->
            <div class="btn-container">
                <?=Html::submitButton(Yii::t('app', 'button_login'))?>
            </div><!-- /.btn-container -->
            <?php ActiveForm::end() ?>
        </div><!-- /.choose-table -->
    </div><!-- /.book-table -->
</section><!-- /#book-table -->
<!-- Book Table  End -->

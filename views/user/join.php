<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 19:54
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/** @var $userJoinForm \app\models\UserJoinForm */

$this->title = Yii::t('app', 'Join');
?>

<!-- Book Table -->
<section id="book-table" class="parallax-style">
    <div class="book-table overlay-light section-padding">
        <div class="section-title-container">
            <h2 class="section-title"><?=$this->title?></h2>
        </div><!-- /.section-title-container -->

        <div class="choose-table">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'choose-table-form'
                ]
            ])?>

                <div class="col-sm-6 form-item">
                    <?=$form->field($userJoinForm, 'username')->textInput(['class' => 'form-control'])?><br>
                </div><!-- /.form-item -->

                <div class="col-sm-6 form-item">
                    <?=$form->field($userJoinForm, 'email')->input('email', ['class' => 'form-control'])?><br>
                </div><!-- /.form-item -->

                <div class="col-sm-6 form-item">
                    <?=$form->field($userJoinForm, 'password')->passwordInput(['class' => 'form-control'])?><br>
                </div><!-- /.form-item -->
                <div class="col-sm-6 form-item">
                    <?=$form->field($userJoinForm, 'passwordRepeat')->passwordInput(['class' => 'form-control'])?><br>
                </div><!-- /.form-item -->
                <div class="btn-container">
                    <?=Html::submitButton(Yii::t('app', 'button_join'))?>
                </div><!-- /.btn-container -->
            <?php ActiveForm::end() ?>
        </div><!-- /.choose-table -->
    </div><!-- /.book-table -->
</section><!-- /#book-table -->
<!-- Book Table  End -->
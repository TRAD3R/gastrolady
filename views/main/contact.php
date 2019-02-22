<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 03.01.19
 * Time: 18:36
 */

/* @var $this \yii\web\View */
/** @var $contactEmailForm \app\models\ContactEmailForm */

use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'contact');
?>

<!-- Contact Us -->
<section id="contact" class="main-contact">
    <div class="contact-section section-padding">
        <div class="section-title-container">
            <h2 class="section-title"><?=Yii::t('app', 'contact')?></h2>
        </div><!-- /.section-title-container -->

        <div class="contact-form-container">
            <div class="row">
                <?php $form = ActiveForm::begin([
                        'options' => [
                                'id' => 'contact-form',
                                'class' => 'wpcf7-form'
                            ]
                        ])?>
                    <div class="col-sm-5">
                        <?=$form->field($contactEmailForm, 'username')->textInput([
                                'class' => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required',
                                'placeholder' => Yii::t('app', 'username')
                        ])?>

                        <?=$form->field($contactEmailForm, 'email')->input('email', [
                            'class' => 'wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email',
                            'placeholder' => Yii::t('app', 'email')
                        ])?>

                        <?=$form->field($contactEmailForm, 'recaptcha')->hiddenInput()->label(false)?>

                    </div><!-- /.col-sm-5 -->

                    <div class="col-sm-7 contact-form-elements">
                        <?=$form->field($contactEmailForm, 'text')->textarea([
                            'class' => 'wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required',
                            'placeholder' => Yii::t('app', 'contact text'),
                            'cols' => 40,
                            'rows' => 10,
                        ])?>

                        <?=\yii\helpers\Html::submitButton(Yii::t('app', 'button_send'),['class' => 'wpcf7-form-control wpcf7-submit'])?>
                    </div><!-- /.col-sm-7 -->

                <?php ActiveForm::end()?>
            </div><!-- /.row -->
        </div><!-- /.contact-form-container -->
    </div><!-- /.contact-section -->
</section><!-- /#contact -->
<!-- Contact Us End -->

<script>
    grecaptcha.ready(function() {
        grecaptcha.execute('6LfPPYkUAAAAALNqTTyKoCIwm1WiH6ndJhWdwOqW', {action: 'homepage'})
            .then(function(token) {
                var recaptcha = document.querySelector("#contactemailform-recaptcha").value = token;


            });
    });
</script>

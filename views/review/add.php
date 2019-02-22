<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 03.01.19
 * Time: 9:47
 */

/* @var $this \yii\web\View */
/* @var $reviewAddForm \app\models\ReviewAddForm */

$this->title = Yii::t('app', 'new review');

use mihaildev\ckeditor\CKEditor;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>
<!-- Book Table -->
<section id="book-table" class="parallax-style">
    <div class="book-table overlay-light section-padding">
        <div class="section-title-container">
            <h2 class="section-title"><?=$this->title?></h2>
        </div><!-- /.section-title-container -->

        <div class="choose-table">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'class' => 'choose-table-form',
                    'enctype' => 'multipart/form-data'
                ]
            ])?>

            <div class="col-sm-12 form-item">
                <?=$form->field($reviewAddForm, 'title')->textInput(['class' => 'form-control'])?><br>
            </div><!-- /.form-item -->

            <div class="col-sm-12 form-item">
                <?=$form->field($reviewAddForm, 'content')->widget(CKEditor::className(),[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                        ],
                    ]);?><br>
            </div><!-- /.form-item -->

            <div class="col-sm-12 form-item">
                <?=$form->field($reviewAddForm, 'mainImage')->fileInput()?><br>
            </div><!-- /.form-item -->
            <div class="col-sm-12 form-item">
                <?= $form->field($reviewAddForm, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
            </div><!-- /.form-item -->
            <div class="btn-container">
                <?=Html::submitButton(Yii::t('app', 'button_save'))?>
            </div><!-- /.btn-container -->
            <?php ActiveForm::end() ?>
        </div><!-- /.choose-table -->
    </div><!-- /.book-table -->
</section><!-- /#book-table -->
<!-- Book Table  End -->

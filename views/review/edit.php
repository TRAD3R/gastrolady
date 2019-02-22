<?php

/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 04.01.19
 * Time: 19:14
 */

/* @var $this \yii\web\View */
/* @var $reviewEditForm \app\models\ReviewAddForm */

use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>

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
                <?=$form->field($reviewEditForm, 'title')->textInput(['class' => 'form-control'])?><br>
            </div><!-- /.form-item -->

            <div class="col-sm-12 form-item">
                <?=$form->field($reviewEditForm, 'content')->widget(CKEditor::class,[
                    'editorOptions' => [
                        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                        'inline' => false, //по умолчанию false
                    ],
                ]);?><br>
            </div><!-- /.form-item -->

            <div class="col-sm-12 form-item">
                <div class="row">
                    <div class="col-xs-2" style="width: 90%" id="mainImage">
                        <img style="width: 10%; height: 10%" src="/images/reviews/<?=$reviewEditForm->mainImage?>" alt="Mister Marbles head tilt">
                    </div>
                </div>
                <?=$form->field($reviewEditForm, 'mainImage')->fileInput()?><br>
            </div><!-- /.form-item -->
            <div class="col-sm-12 form-item">
                <div class="row">
                    <div class="col-xs-2" style="width: 90%" id="gallery">
                        <?php $images = explode(",", $reviewEditForm->gallery);
                            foreach ($images as $image): ?>
                            <img style="width: 10%; height: 10%; float: left; margin-right: 10px" src="/images/reviews/<?=$image?>" alt="Mister Marbles head tilt">
                        <?php endforeach; ?>
                    </div>
                </div>
                <?= $form->field($reviewEditForm, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
            </div><!-- /.form-item -->
            <div class="btn-container">
                <?=Html::submitButton(Yii::t('app', 'button_save'))?>
            </div><!-- /.btn-container -->
            <?php ActiveForm::end() ?>
        </div><!-- /.choose-table -->
    </div><!-- /.book-table -->
</section><!-- /#book-table -->
<!-- Book Table  End -->

<?php
$js = <<<JS
    
JS;
$this->registerJs($js);
?>

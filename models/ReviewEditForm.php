<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 03.01.19
 * Time: 9:42
 */

namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class ReviewEditForm extends Model
{
    public $title;
    public $content;

    /**
     * @var UploadedFile
     */
    public $mainImage;
    /**
     * @var UploadedFile[]
     */
    public $gallery;

    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['mainImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, jpeg'],
            [['gallery'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif, jpeg', 'maxFiles' => 20],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if($this->mainImage) {
                $filename = date("Y-m-d-H-i-s", time());
                $this->mainImage->saveAs('images/reviews/' . $filename . '.' . $this->mainImage->extension);
                $this->mainImage = $filename . '.' . $this->mainImage->extension;
            }
            if($this->gallery) {
                $iterator = 1;
                $tmpGallery = [];
                foreach ($this->gallery as $file) {
                    $tmpFile = $filename . "-" . $iterator++ . '.' . $file->extension;
                    $file->saveAs('images/reviews/' . $tmpFile );
                    $tmpGallery[] = $tmpFile;
                }
                $this->gallery = implode(",", $tmpGallery);
            }
            return true;
        } else {
            return false;
        }
    }

    public function attributeLabels()
    {
        return [
            'title' => \Yii::t('app', 'title'),
            'content' => \Yii::t('app', 'content'),
            'mainImage' => \Yii::t('app', 'main image'),
            'gallery' => \Yii::t('app', 'gallery'),
        ];
    }
}
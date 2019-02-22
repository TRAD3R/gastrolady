<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 18:40
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class ArticleMeta extends ActiveRecord
{
    public static function tableName()
    {
        return "trd_article_meta";
    }

    public function getArticle(){
        return $this->hasOne(Articles::class, ['id' => 'article_id']);
    }

    public static function findByUrl($url){
        return static::find()
            ->where(['url' => $url, 'lang' => Yii::$app->language])
            ->one();
    }

    public static function getPrevArticle($id){
        return static::find()
            ->select('url, title')
            ->where("id < $id AND lang = '" . Yii::$app->language ."'")
            ->orderBy('id DESC')
            ->limit('1')
            ->one();
    }

    public static function getNextArticle($id){
        return static::find()
            ->select('url, title')
            ->where("id > $id AND lang = '" . Yii::$app->language ."'")
            ->orderBy('id ASC')
            ->limit('1')
            ->one();
    }

    /**
     * Create url for review
     */
    public function createUrl() {
        // переводим в транслит
        $str = $this->rus2translit($this->title);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);

        // удаляем начальные и конечные '-'
        $this->url = trim($str, "-");
    }

    /**
     * @param $string
     * @return string
     */
    private function rus2translit($string) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '',  'ы' => 'y',   'ъ' => '',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '',  'Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
    }
}
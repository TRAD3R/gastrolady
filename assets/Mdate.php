<?php
/**
 * вывод, получение, преобраззование даты в разных форматах
 * возможно добавить расчет времени при поиске.
 * Автор: tbs-mbs.*
 */

namespace app\assets;

use Yii;

final class Mdate
{

    /**
     * "локализация" даты
     */
    private static function transl_longdate_2ru($str_date) {
        $full_ru_month = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
            'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];

        $full_en_month = ['january', 'february', 'march', 'april', 'may', 'june',
            'july', 'august', 'september', 'october', 'november', 'december'];

        $ru_date = str_ireplace($full_en_month, $full_ru_month, $str_date);
        return($ru_date);
    }

    /**
     * краткие названия месяцев
     */
    private static function transl_shotdate_2ru($str_date) {
        $shot_en_month = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
        $shot_ru_month = ['янв', 'фев', 'мар', 'апр', 'май', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'];
        $ru_date = str_ireplace($shot_en_month, $shot_ru_month, $str_date);
        return($ru_date);
    }

    /**
     * 18 декабря 2018, 16:17
     */
    public static function show_long_date($date) {
        $long_dt = (date('d F Y, H:i', $date));
        $long_dt = Yii::$app->language == 'ru' ? static::transl_longdate_2ru($long_dt) : $long_dt;
        return $long_dt;
    }

    /**
    / 18 дек 2018, 16:17
     */
    public static function show_shot_date($date) {
        $shot_dt = (date('d M Y, H:i', $date));
        $shot_dt = Yii::$app->language == 'ru' ? static::transl_shotdate_2ru($shot_dt) : $shot_dt;
        return $shot_dt;
    }

    /**
     * 18/12/2018, 16:17
     */
    public function show_digit_date($date) {
        $digit_dt = (date('d/m/Y, H:i', $date));
        //дата из бд уже будут в цифровом формате (год-мес-день час:ми:сек)
        //но ее нужно "исправить" день мес год
        return $digit_dt;
    }

    ////////////////////////////////////////////////////
    /**
     * day of week (1-7)
     */
    public function get_day_of_week() {
        $dow = (date('N', time()));   //день недели
        return($dow);
    }

    /**
     * yyyy-mm-dd
     */
    public function get_curdate_ymd() {
        $ymd = (date('Y-m-d', time()));
        return($ymd);
    }

    /**
     * yyyy-mm-dd hh:mm:ss
     */
    public function get_curdate_digit() {
        $digit = (date('Y-m-d H:i:s', time()));
        return($digit);
    }

    /**
     * Unix-time 2 mysqlDate
     */
    public function unixtime2mysqldate($utime) {
        $mysqldate = (date('Y-m-d H:i:s', $utime));
        return($mysqldate);
    }

}

?>
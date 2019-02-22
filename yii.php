<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 18:08
 */

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/vendor/yiisoft/yii2/Yii.php";
$config = require_once __DIR__ . "/config/console.php";

$application = new \yii\console\Application($config);
$application->run();
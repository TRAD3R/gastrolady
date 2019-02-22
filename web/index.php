<?php

define("YII_DEBUG", true);

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../vendor/yiisoft/yii2/Yii.php";
$config = require_once __DIR__ . "/../config/web.php";
$application = new \yii\web\Application($config);
$application->run();
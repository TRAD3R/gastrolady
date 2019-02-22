<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 15:07
 */
$db = require_once "db.php";

return [
    "id" => "gastrolady",
    "basePath" => dirname(__DIR__ ),
    "bootstrap" => ['debug'],
    'name' => 'Gastrolady',
    'language' => 'ru',
    "modules" => [
        "debug" => "yii\debug\Module"
    ],
    "components" => [
        'request' => [
            "cookieValidationKey" => "gastrolady main site",
            'baseUrl' => ''
        ],
        "urlManager" => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'main/index',
                'reviews' => 'review/list',
                'review/<a:add|remove>' => 'review/<a>',
                'review/edit/<id:\d+>' => 'review/edit',
                'review/<a>' => 'review/view',
                //вывод отдельной страницы
                '<a>' => 'main/<a>',
            ]
        ],
        "errorHandler" => [
            "errorAction" => "main/404"
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,   // отключение дефолтного jQuery
                    'js' => [
                        '//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js', // добавление вашей версии
                    ]
                ],
            ],
        ],
        'db' => $db,
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'gastrolady@yandex.ru',
                'password' => '99hXLw7V2uWdGKk',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
    ]

];
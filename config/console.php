<?php
/**
 * Created by PhpStorm.
 * User: trad3r
 * Date: 02.01.19
 * Time: 18:15
 */
$db = require_once 'db.php';

return [
    'id' => 'gastrolady_console',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => $db,
    ]
];
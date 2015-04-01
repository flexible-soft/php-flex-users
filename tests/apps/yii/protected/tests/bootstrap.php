<?php

// change the following paths if necessary
$yiit = dirname(__FILE__).'/../../../../../vendor/autoload.php';
$config = dirname(__FILE__).'/../config/test.php';

defined('YII_TEST') or define('YII_TEST', true);

require_once $yiit;

Yii::createWebApplication($config);

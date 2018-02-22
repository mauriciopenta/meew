<?php

// change the following paths if necessary
$yii = dirname(__FILE__) . '/protected/vendor/yiisoft/yii/framework/yii.php';
$composerAutoloader = dirname(__FILE__) . '/protected/vendor/autoload.php';
$config = dirname(__FILE__) . '/protected/config/main.php';
ini_set('memory_limit', '-1');

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($composerAutoloader);

require_once($yii);
Yii::setPathOfAlias('vendor', 'protected/vendor');
require_once($yii);
Yii::createWebApplication($config)->run();

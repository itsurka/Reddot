<?php
ini_set('error_reporting', E_ERROR); //E_ALL & ~E_NOTICE & ~E_DEPRECATED);
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$global_functions=dirname(__FILE__).'/protected/config/global.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
 defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
require_once($global_functions);
Yii::createWebApplication($config)->run();
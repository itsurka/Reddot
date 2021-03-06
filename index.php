<?php
//ini_set('error_reporting', E_ERROR); //E_ALL & ~E_NOTICE & ~E_DEPRECATED);

error_reporting(E_ERROR);
ini_set('display_errors', 1);

// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/YiiBase.php';
$global_functions=dirname(__FILE__).'/protected/config/global.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
 defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($global_functions);
require_once($yii);

class Yii extends YiiBase {
    /**
     * @static
     * @return CWebApplication
     */
    public static function app()
    {
        return parent::app();
    }
}
$app = Yii::createWebApplication($config)->run();
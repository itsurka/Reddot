<?php

//echo dirname(__FILE__).'/params.php';die();
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Актуальные скидки RedDot',
    'defaultController' => 'Site',
    'homeUrl' => '/index',
    'language' => 'ru',
    // preloading 'log' component
    'preload' => array('log', 'shoppingCart'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.helpers.*',
        'application.extensions.EWideImage.WideImage', //WideImage
    ),
    'defaultController' => 'acts',
    'modules' => array(
        'admin',
        'cityadmin',
        'manager',
        // uncomment the following to enable the Gii tool
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'hellonomore',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array($_SERVER['REMOTE_ADDR'], '::1'),
        //'ipFilters' => array('95.30.57.151', '::1'),
        ),
    ),
    // application components
    'components' => array(
        'qiwi' => array(
            'class' => 'ext.qiwi.Qiwi',
            'login' => 201501,
            'password' => 'e5hvyyux',
        ),
        'shoppingCart' =>
        array(
            'class' => 'application.components.shoppingCart.EShoppingCart',
        ),
        'format' => array(
            'dateFormat' => 'd m Y'
        ),
        'email' => array(
            'class' => 'ext.email.Email',
            'delivery' => 'php', //Will use the php mailing function.  
        //May also be set to 'debug' to instead dump the contents of the email into the view
        ),
        'registry' => array(
            'class' => 'Registry'
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'WebUser',
            'loginUrl' => '/user/login',
        ),
        //авторизация с RBAC
        'authManager' => array(
            // Будем использовать свой менеджер авторизации
            'class' => 'PhpAuthManager',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array('guest'),
        ),
        'image' => array(
            'class' => 'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver' => 'GD',
            // ImageMagick setup path
            'params' => array('directory' => '/opt/local/bin'),
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'urlSuffix' => '',
            'rules' => array(
                '<module:(admin|cityadmin|manager)>' => '<module>',
                //
                'index' => '/acts/index',
                'map' => '/acts/map',
                'archive' => '/acts/archive',
                'bonus' => '/acts/bonus',
                'search' => '/acts/search',
                //
                'page/<pageName:\w+>' => 'page/view',
                'feedback' => 'site/feedback',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'post/<id:\d+>/<title:.*?>' => 'post/view',
                'posts/<tag:.*?>' => 'post/index',
                'rss' => 'acts/rss',
                '<actName:[a-zA-Z0-9-_]+>' => 'acts/view',
            ),
        ),
        // uncomment the following to use a MySQL database
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=reddot',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'initSQLs'=>array("set time_zone='+03:00';"),
        ),
        /*'db' => array(
            'connectionString' => 'mysql:host=mysql16.000webhost.com;dbname=a2203413_reddot',
            'emulatePrepare' => true,
            'username' => 'a2203413_reddot',
            'password' => 'aUNJnb^7h^%$R%Y&Ids',
            'charset' => 'utf8',
        ),*/
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages
              /*array(
              'class'=>'CWebLogRoute',
              ),*/
            ),
        ),
    ),
    'params' => require(dirname(__FILE__) . '/params.php')
);
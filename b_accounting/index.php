<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);

//**
$zend=dirname(__FILE__).'/protected/vendors/Zend/Loader/Autoloader.php';
require_once ($zend);

Yii::import("Zend_Loader_Autoloader", true);
Yii::registerAutoloader(array("Zend_Loader_Autoloader", "autoload"));
//*/
Yii::createWebApplication($config)->run();

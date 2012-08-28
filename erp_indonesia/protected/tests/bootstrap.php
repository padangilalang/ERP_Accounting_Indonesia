<?php

// change the following paths if necessary
$yiit=dirname(__FILE__).'/../../../framework/yiit.php';
$config=dirname(__FILE__).'/../config/test.php';

require_once($yiit);
require_once(dirname(__FILE__).'/WebTestCase.php');

require(dirname(__FILE__) . '/../extensions/wunit/WUnit.php');
WUnit::createWebApplication($config);

//Yii::createWebApplication($config);

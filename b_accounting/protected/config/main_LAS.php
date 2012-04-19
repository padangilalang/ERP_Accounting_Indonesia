<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>'CV Laksana',

		// preloading 'log' component
		'preload'=>array('log','bootstrap'),

		// autoloading model and component classes
		'import'=>array(
				'application.models.*',
				'application.components.*',
				'application.extensions.*',
				'application.reports.*',
				'application.extensions.fpdf.*',
				'application.extensions.xupload.*',
				'ext.bootstrap.widgets.*',
				//'application.extensions.phpmailer.*',
				//'application.extensions.pChart.*',
				//'application.extensions.php-sip.*',   //on trial

		),
		/**/
		'modules'=>array(
				'gii'=>array(
						'class'=>'system.gii.GiiModule',
						'password'=>'1234qwe',
						'generatorPaths'=>array(
								//'ext.gtc' // a path alias
								'bootstrap.gii', // since 0.9.1
						),
				),
		),
		/**/

		'defaultController'=>'menu',

		'timeZone'=>'Asia/Jakarta',
		'sourceLanguage'=>'id_id',
		//'language'=>'id',

		'theme'=>'artisteer',
		//'theme'=>'artisteer_fullbootstrap',

		// application components
		'components'=>array(

				'cache'=>array(
						'class'=>'system.caching.CFileCache',
				),
					
				'settings'=>array(
						'class'                 => 'CmsSettings',
						'cacheComponentId'  => 'cache',
						'cacheId'           => 'global_website_settings',
						'cacheTime'         => 84000,
						'tableName'     => 's_settings',
						'dbComponentId'     => 'db',
						'createTable'       => true,
						'dbEngine'      => 'InnoDB',
				),


				'bootstrap'=>array(
						'class'=>'ext.bootstrap.components.Bootstrap',
				),

				'user'=>array(
						// enable cookie-based authentication
						'allowAutoLogin'=>true,
				),
				'db'=>array(
						'connectionString' => 'mysql:host=localhost;dbname=laksana',
						'username' => 'laksana',
						'emulatePrepare' => true,
						//'username' => 'accounting',
						'password' => '1234qwe',
						'charset' => 'utf8',
						'tablePrefix' => '',
				),
				'errorHandler'=>array(
						// use 'site/error' action to display errors
						'errorAction'=>'site/error',
				),

				/*		'urlManager'=>array(
				 'urlFormat'=>'path',
						//'showScriptName'=>false,
						'rules'=>array(
								'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
						),
				),
*/
				'log'=>array(
						'class'=>'CLogRouter',
						'routes'=>array(
								array(
										'class'=>'CFileLogRoute',
										'levels'=>'error, warning',
								),
								// uncomment the following to show log messages on web pages
								/*
								 array(
								 		'class'=>'CWebLogRoute',
										'levels'=>'trace',
										'categories'=>'vardump',
										'showInFireBug'=>true
								),
*/
						),
				),
		),

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>require(dirname(__FILE__).'/params.php'),
);
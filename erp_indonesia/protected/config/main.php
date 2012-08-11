<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
		'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
		'name'=>'ERP Indonesia',

		// preloading 'log' component
		'preload'=>array('log','bootstrap'),

		// autoloading model and component classes
		'import'=>array(
				'application.models.*',
				'application.components.*',
				'application.extensions.*',
				'application.reports.*',
				'ext.fpdf.*',
				'ext.bootstrap.widgets.*',
				//'ext.facebook.*',
				//'ext.facebook.lib.*',
				'ext.JasPHP.*',

		),
		'modules'=>array(
				'm1',
				'm2',
				/**/
				'gii'=>array(
						'class'=>'system.gii.GiiModule',
						'password'=>'1234qwe',
						'generatorPaths'=>array(
								'bootstrap.gii', // Since 0.9.1
						),
				),
				/**/
				//masih lumayan OK
				'cal' => array(
						'debug' => true // For first run only!
				),
		),

		'defaultController'=>'site/login',

		'timeZone'=>'Asia/Jakarta',
		'sourceLanguage'=>'id_id',
		//'language'=>'id',

		'theme'=>'artisteer_bootstrap',

		// application components
		'components'=>array(
				//'widgetFactory'=>array(
				//	'widgets'=>array(
						//'CJuiAutoComplete'=>array(
						//	'options'=>array(
						//		'minLength'=>'3',
						//	),
						//),
				//	),
				//),
				'jasPHP' => array(
						'class' => 'JasPHP',
				),
				'cache'=>array(
					'class'=>'system.caching.CFileCache',
					//'cache'=>'CZendDataCache',
				),
					
				'session' => array(
					'class' => 'CCacheHttpSession',
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
						'connectionString' => 'mysql:host=localhost;dbname=erp_indonesia',
						'emulatePrepare' => true,
						'username' => 'erp_indonesia',    //mysql
						'password' => '1234qwe',
						'charset' => 'utf8',
						'tablePrefix' => '',
						'enableProfiling'=>true,
						'enableParamLogging' => true,
						'schemaCachingDuration' => 180,						
				),
				'errorHandler'=>array(
						// use 'site/error' action to display errors
						'errorAction'=>'site/error',
				),

				/**/
				 'urlManager'=>array(
				 		'urlFormat'=>'path',
				 		//'showScriptName'=>false,
				 		'rules'=>array(
				 				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				 				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				 				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				 		),
				 ),
				/**/

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
								 ),
*/
/*							array(
 'class'=>'ext.db_profiler.DbProfileLogRoute',
		'countLimit' => 1, // How many times the same query should be executed to be considered inefficient
		'slowQueryMin' => 0.01, // Minimum time for the query to be slow
),
*/
						),
				),
		),

		// application-level parameters that can be accessed
		// using Yii::app()->params['paramName']
		'params'=>require(dirname(__FILE__).'/params.php'),
);
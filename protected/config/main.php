<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>false,
    'params'=>array(
		// this is used in contact page
		'adminEmail'=>'mos_artem2@mail.ru',
	),
    'language'=>'ru',
	// preloading 'log' component
	'preload'=>array('log'),
   // 'defaultController'=>'test/tests',
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
    'theme'=>'bootstrap',   
	'modules'=>array(
		// uncomment the following to enable the Gii tool
        'test'=> array(
            'defaultController'=>'test',
           // 'layout'=>'application.modules.admin.views.layouts.main',
        ),
		'admin'=> array(
            'defaultController'=>'user',
           // 'layout'=>'application.modules.admin.views.layouts.main',
        ),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'1',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths'=>array(
                             'bootstrap.gii',
                         ),
		),
		
	),

	// application components
	'components'=>array(
		'user'=>array(
            'class' => 'WebUser',
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
        
		// uncomment the following to enable URLs in path-format
	/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
	//	*/
	/*	'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
	//*/
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1:63306;dbname=testsBD',
			'emulatePrepare' => true,
			'username' => 'art',
			'password' => '1',
			'charset' => 'utf8',
           // 'enableProfiling'=>true, //DELETE
		),
	    
        'authManager' => array(
            // Будем использовать свой менеджер авторизации
            'class' => 'PhpAuthManager',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array('guest'),
        ),
        
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				//DELETE
				array(
					'class'=>'CWebLogRoute',
				),//*/
				
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']

);
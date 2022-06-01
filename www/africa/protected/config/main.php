<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Africa',
	'language'=>'es',
	'sourceLanguage'=>'es',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		'application.extensions.yii-mail.*',
	),

	'modules'=>array(

		'rights' => array(
            'install' => false,
            'userIdColumn' => 'id',
            'userNameColumn' => 'nombreUsuario',
        ),
		'gii'=>array(
			'generatorPaths' => array(
          'bootstrap.gii'),
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array(),
		),
	),

	// application components
	'components'=>array(
		'mailer' => array(
    'class' => 'ext.swiftMailer.SwiftMailer',
    // For SMTP
    'mailer' => 'smtp',
    'host'=>'mail.softer.com.ar',
    'From'=>'admin@localhost',
    'username'=>'africa@softer.com.ar',
    'password'=>'123456',
),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'RWebUser',

		),
		'authManager'=>array(
			'class'=>'RDbAuthManager',
		),
		 'bootstrap'=>array(
            'class' => 'ext.bootstrap.components.Bootstrap',
	    	'responsiveCss' => true,
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
		*/
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		'db'=>array(
			// 'connectionString' => 'mysql:host=localhost;dbname=africa', //de la base africa
			'connectionString' => 'mysql:host=db;dbname=africa',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'vertrigo',
			'charset' => 'utf8',
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
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
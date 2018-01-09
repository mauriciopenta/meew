<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'meew',
	'language'=>'es',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'vendor.z_bodya.yii-image.*',
        'vendor.z_bodya.yii-gallery-manager.*',
        'vendor.z_bodya.yii-image-attachment.*',
        'vendor.z_bodya.yii-gallery-manager.models.*',
        'vendor.z_bodya.yii-tinymce.*',
        'vendor.z_bodya.yii-elfinder.*',
	),
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'root',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
	),
// application components
	'components'=>array(

		'image' => array(
			'class' => 'CImageComponent',
			'driver' => 'GD',
		),	

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
            'session' => array(
                'autoStart'=>true,
			),
		
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),


		
//		'db'=>array(
//			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
//		),
		// uncomment the following to use a MySQL database
		
//		'db'=>array(
//                    'tablePrefix'=>'',
//                    'connectionString' => 'pgsql:host=ec2-174-129-242-241.compute-1.amazonaws.com;port=5432;dbname=d1b9pv88jl26t9',
//                    'username'=>'ajrbjyuywyluwm',
//                    'password'=>'sRVVqYKhD2bdn_qWz6tCYSP71h',
//                    'charset'=>'UTF8',
//                ),
		'db'=>array(
                    'tablePrefix'=>'',
                    'connectionString' => 'mysql:host=localhost;port=3306;dbname=meewco_meew',
				    'username'=>'meewco_meew',
                    'password'=>'Meew2017!',
                    'charset'=>'UTF8',
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
		),'clientScript'=>array(
                    'packages'=>array(
                        'jquery'=>array(
                            'baseUrl'=>'https://code.jquery.com/',
                            'js'=>array('jquery-2.2.3.min.js'),
                        )
                    ),
                ),
                'mail' => array(
			'class' => 'application.extensions.yii-mail-master.YiiMail',
			'transportType'=>'smtp',
			'transportOptions'=>array(
				'host'=>'smtp.gmail.com',				
				'username'=>'soportecentroforjar@gmail.com',
				'password'=>"SDIS_&%_1",
				'port'=>'465',
				'encryption'=>'tls',
			),
				'viewPath' => 'application.views.mail',
				'logging' => true,
				'dryRun' => false
					),
					
				
			
		



                    'user'=>array(
                    // enable cookie-based authentication
                    'allowAutoLogin'=>true,
		),
        



	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'postsPerPage'=>10,
		// maximum number of comments that can be displayed in recent comments portlet
		'recentCommentCount'=>10,
		// maximum number of tags that can be displayed in tag cloud portlet
		'tagCloudCount'=>20,
		// whether post comments need to be approved before published
		'commentNeedApproval'=>true,
	),
);
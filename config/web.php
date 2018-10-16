<?php

$params = require(__DIR__ . '/params.php');

$activeFrontTheme = $params['activeFrontTheme'];
$activeAdminTheme = $params['activeAdminTheme'];

$config = [
    'id' => 'atc-art-techno',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    
    // default language to use for i18n purpose
    // source translation is located in @app/messages directory
    'language' => 'id-ID',
    
    //'catchAll' => ['site/maintenance'],
	
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'tBSy4UNPaOrZNGWeFnMIj7qElAkTt5Vq',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            //'enableAutoLogin' => true,
            'enableSession' => true,
            'authTimeout' => 60 * 60, /* 1 hour */
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => require(__DIR__ . '/mailer.php'),
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en-US',
                    'basePath' => '@app/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app.menu' => 'app.menu.php',
                        'app.message' => 'app.message.php',
                        'app.button' => 'app.button.php',
                        'app.static' => 'app.static.php',
                    ],
                ],
            ],
		],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => require(__DIR__ . '/url-manager.php'),
        'view' => [
            'class' => 'app\components\View',
			'theme' => [
				'pathMap' => [
                    '@app/views' => '@app/themes/'.$activeFrontTheme.'/views',
                    '@app/widgets' => '@app/themes/'.$activeFrontTheme.'/widgets',
					/** for administrator module */
                    '@app/modules/administrator/views' => '@app/themes/'.$activeAdminTheme,
				],
			],
		],
		'assetManager' => [
			'bundles' => [
				'dmstr\web\AdminLteAsset' => [
					'skin' => 'skin-blue-light',
				],
			],
		],
    ],
    'modules' => [
        'gridview' => [
			'class' => '\kartik\grid\Module'
		],
        'administrator' => [
            'class' => 'app\modules\administrator\Module',
        ],
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',

            // the global settings for the Disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'hendrigunawan']
            ],
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
    
    $config['modules']['utility'] = [
        'class' => 'c006\utility\migration\Module',
    ];
}

return $config;

<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'request' => [
            'class' => '\yii\web\Request',
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'urlManager' => [
            // 'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        
        // 'user' => [
        //     'identityClass' => 'common\models\User',
        //     // 'identityClass' => '..\vendor\webvimark\module-user-management\models\User',
        //     'enableAutoLogin' => true,
        //     'identityCookie' => [
        //         'name' => '_frontendUser', // unique for frontend
        //         'path'=>'/frontend/web'  // correct path for the frontend app.
        //     ]
        // ],
        // 'session' => [
        //     'name' => '_frontendSessionId', // unique for frontend
        //     'savePath' => __DIR__ . '/../runtime', // a temporary folder on frontend
        // ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
  
    'params' => $params,
];

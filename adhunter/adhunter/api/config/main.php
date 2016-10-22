<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'   // here is our v1 modules
        ]
    ],
    'components' => [
                // 's3bucket' => [
                //     'class' => \frostealth\yii2\aws\s3\Storage::className(),
                //     'region' => 'us-west-2',
                //     'credentials' => [ // Aws\Credentials\CredentialsInterface|array|callable
                //         'key' => 'AKIAJRIEWCLLHOULMD7A',
                //         'secret' => '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',
                //     ],
                //     'bucket' => 'site.advisorhunter',
                //     // 'cdnHostname' => 'http://example.cloudfront.net',
                //     'defaultAcl' => \frostealth\yii2\aws\s3\Storage::ACL_PUBLIC_READ,
                //     'debug' => false, // bool|array
                // ],
                'user' => [
                    'identityClass' => 'api\modules\v1\models\User',
                    'enableAutoLogin' => true,
                    'enableSession' => false
                ],
                'log' => [
                    'traceLevel' => YII_DEBUG ? 3 : 0,
                    'targets' => [
                        [
                            'class' => 'yii\log\FileTarget',
                            'levels' => ['error', 'warning'],
                        ],
                    ],
                ],
            'urlManager' => [
                'enablePrettyUrl' => true,
                'enableStrictParsing' => true,
                'showScriptName' => false,
                'rules' => [
                    [
                        'class' => 'yii\rest\UrlRule',
                        'controller' => ['v1/country', 'v1/city', 'v1/bid', 'v1/answer', 'v1/backgroundcheck', 'v1/bilingcode', 'v1/campaignemail',
                                         'v1/category', 'v1/company', 'v1/companylicense', 'v1/companyrating', 'v1/companyreviewbyexternalcompany','v1/emailtemplates',
                                         'v1/lead', 'v1/payment', 'v1/project', 'v1/question', 'v1/questiontype', 'v1/referral', 'v1/refund', 'v1/state',
                                         'v1/subcategory', 'v1/token', 'v1/tokenbalance', 'v1/tokencounts', 'v1/userdetails', 'v1/zipcode',
                                         'v1/companyreviewcomment', 'v1/companyservicearea', 'v1/companyservices', 'v1/companyproject', 'v1/api'],
                        'tokens' => [
                            '{id}' => '<id:\\w+>'
                        ],
                        'extraPatterns' => [
                            'GET questions-by-category/<categoryid:\\d+>' => 'questions-by-category',
                            'GET options-by-question/<questionid:\\d+>' => 'options-by-question',
                            'GET pro-by-zip/<zipcode:\\d+>' => 'pro-by-zip',
                            'POST login' => 'login',
                            'GET dashboard' => 'dashboard',
                            'GET companyprojects' => 'companyprojects',
                            'POST signup' => 'signup',
                            'POST pro-signup' => 'pro-signup',
                            'GET get-subcategory-by-category/<catid:\\d+>' => 'get-subcategory-by-category',

                            'GET company-license-by-company/<companyid:\\d+>' => 'company-license-by-company',
                            'GET company-backcheck-by-company/<companyid:\\d+>' => 'company-backcheck-by-company',
                            'GET service-area-by-company/<companyid:\\d+>' => 'service-area-by-company',
                            'GET services-by-company/<companyid:\\d+>' => 'services-by-company',
                            'GET liecense-by-company/<companyid:\\d+>' => 'liecense-by-company',
                            'GET company-reviews-by-company/<companyid:\\d+>' => 'company-reviews-by-company',
                            'GET ratings-by-review/<reviewid:\\d+>' => 'ratings-by-review',
                            'GET project-by-company/<companyid:\\d+>' => 'project-by-company',
                            'GET images-by-project/<projectid:\\d+>' => 'images-by-project',
                            'GET location-by-zipcode/<zipcode:\\d+>' => 'location-by-zipcode',
                            'GET location-by-zipid/<zipid:\\d+>' => 'location-by-zipid',
                            'GET profileproject-by-company/<companyid:\\d+>' => 'profileproject-by-company',  //ProjectsByCompany

                            'POST update-company-name' => 'update-company-name',
                            'POST update-company-about' => 'update-company-about',
                            'POST update-company-personalinfo' => 'update-company-personalinfo',
                            'POST update-company-banner' => 'update-company-banner',
                            'POST update-company-pic' => 'update-company-pic',
                            'POST update-company-services' => 'update-company-services',
                            'POST update-company-license' => 'update-company-license',
                            'POST delete-service-area' => 'delete-service-area',
                            'POST save-service-area' => 'save-service-area',
                            'GET home-list' => 'home-list',
                            'POST add-review' => 'add-review',
                            'POST save-company-rating-review' => 'save-company-rating-review',
                        ],
                    ]
                ],
            ],
        'request' => [
             'class' => '\yii\web\Request',
             'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                header("Access-Control-Allow-Origin : *");
                // header("Access-Control-Allow-Headers": "Authorization, Content-Type");
                // header("Access-Control-Allow-Methods": "GET,HEAD,OPTIONS,POST,PUT");

                // header("Access-Control-Allow-Headers": "Authorization, Content-Type");
                // header('Access-Control-Allow-Credentials': 'true');

                // header("Access-Control-Allow-Origin: http://localhost");
                // header("Access-Control-Allow-Origin: http://52.20.134.132");
                // header("Access-Control-Allow-Origin: http://sachin");

                // header("Access-Control-Allow-Headers", "Content-Type, authorization");
                //header("Access-Control-Allow-Headers:X-HTTP-Method-Override, Content-Type, x-requested-with");

            }
        ]

    ],
    'params' => $params,
];
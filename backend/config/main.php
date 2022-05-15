<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$db = require __DIR__ . '/db.php';
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'user',
                    'extraPatterns' => [
                        'GET by-username/<username>' => 'by-username',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'post',
                    'extraPatterns' => [
                        'GET by-author/<username>' => 'by-author',
                        'GET by-author-id/<id>' => 'by-author-id',
                        'GET replies/<id>' => 'replies',
                        'GET limit/<offset>/<page>' => 'limit',
                    ]
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'friend',
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'like',
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'notification',
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'popular',
                    'extraPatterns' => [
                        'GET limit/<count>' => 'limit',
                    ]
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];

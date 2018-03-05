<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'VÄSTERORT TRAFIKSKOLA',
    'language' => 'sv',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HkblSYqkGimML2i2PynsozFA0swKu7yb',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                'admin/login' => 'site/login',
                'admin/logout' => 'site/logout',
                'admin/packages' => 'package/index',
                'admin/packages/<action:\w>' => 'package/<action>',
                'admin/package-details' => 'package-detail/index',
                'admin/package-details/<action:\w>' => 'package-detail/<action>',
                'admin/contact-form' => 'contact-form/index',
                'admin/contact-form/<action:\w>' => 'contact-form/<action>',
            ],
        ],

        'formatter' => [
            'decimalSeparator' => ',',
            'thousandSeparator' => '&nbsp;',
            'currencyCode' => 'SEK',
            'dateFormat' => 'php:Y-m-d',
            'timeFormat' => 'php:H:i',
            'datetimeFormat' => 'php:Y-m-d H:i',
            'numberFormatterOptions' => [
                    NumberFormatter::MIN_FRACTION_DIGITS => 0,
                    NumberFormatter::MAX_FRACTION_DIGITS => 2,
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

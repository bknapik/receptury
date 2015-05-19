<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'auth' => [
            'class' => 'auth\Module',
            'layout' => '//homepage', // Layout when not logged in yet
            'layoutLogged' => '//main', // Layout for logged in users
            'attemptsBeforeCaptcha' => 3, // Optional
            'supportEmail' => 'knapik@bmj.pl', // Email for notifications
            'passwordResetTokenExpire' => 3600, // Seconds for token expiration
            'superAdmins' => ['knapikk'], // SuperAdmin users
            //'signupWithEmailOnly' => false, // false = signup with username + email, true = only email signup
            'tableMap' => [ // Optional, but if defined, all must be declared
                'User' => 'user',
                'UserStatus' => 'user_status',
                'ProfileFieldValue' => 'profile_field_value',
                'ProfileField' => 'profile_field',
                'ProfileFieldType' => 'profile_field_type',
            ],
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'oHBDan5n-rYs5O3OWB7sgX62nHB05LYc',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
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
        'db' => require(__DIR__ . '/db.php'),
        'authManager' => [
            'class' => '\yii\rbac\DbManager',
            'ruleTable' => 'AuthRule', // Optional
            'itemTable' => 'AuthItem',  // Optional
            'itemChildTable' => 'AuthItemChild',  // Optional
            'assignmentTable' => 'AuthAssignment',  // Optional
            'defaultRoles' => ['guest'],
        ],
        'user' => [
            'class' => 'auth\components\User',
            'identityClass' => 'auth\models\User', // or replace to your custom identityClass
            'enableAutoLogin' => true,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;

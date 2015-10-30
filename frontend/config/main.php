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
            'enableAutoLogin' => true,
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
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => yii\i18n\DbMessageSource::className(),
                    'sourceLanguage' => 'en-US',
                    'forceTranslation' => true,
                    'sourceMessageTable' => '{{%source_message}}',
                    'messageTable' => '{{%translated_message}}',
                    /*'on missingTranslation' => ['common\components\TranslationEventHandler',
                                                'handleMissingTranslation'
                                                ],*/

                ],
            ],
        ],
        /*TODO: Remove "index" on language URLs i.e.: /es-ES/index */
        'urlManager' => [
            'class'             => common\components\MultiLingualUrlManager::className(),
            'enablePrettyUrl'   => true,
            'showScriptName'    => false, // false - means that index.php will not be part of the URLs
            'rules' => [
                '<language>/<action>' => 'site/<action>',
                '/' => 'site/index',
                '<action>' => 'site/<action>',
                '<language>/<controller>/<action>/<id>' => '<controller>/<action>',
                '<language>/<controller>/<action>' => '<controller>/<action>',
                '<language>/<controller>/<id>' => '<controller>',
            ],
        ],
    ],
    'params' => $params,
];

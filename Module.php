<?php
/**
 * Created by PhpStorm.
 * User: smirnovrm
 * Date: 16.03.2018
 * Time: 9:51
 */

namespace fedornabilkin\redirect;


use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module {

    public $frontendHost;
    public $controllerNamespace = 'fedornabilkin\redirect\controllers';

    public function init() {

        parent::init();
        if (!isset(\Yii::$app->i18n->translations['redirect*'])) {
            \Yii::$app->i18n->translations['redirect*'] = [
                'class' => PhpMessageSource::class,
                'sourceLanguage' => 'ru',
                'basePath' => __DIR__ . '/messages',
            ];
        }

    }

}
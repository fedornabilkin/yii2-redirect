<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA-PC
 * Date: 17.03.2018
 * Time: 12:16
 */

namespace fedornabilkin\redirect;


use yii\base\BootstrapInterface;
use yii\i18n\PhpMessageSource;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app->hasModule('redirect') && ($module = $app->getModule('redirect')) instanceof Module) {

            if (!isset($app->get('i18n')->translations['redirect*'])) {
                $app->get('i18n')->translations['redirect*'] = [
                    'class' => PhpMessageSource::className(),
                    'basePath' => __DIR__ . '/messages',
                    'sourceLanguage' => 'ru'
                ];
            }
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA-PC
 * Date: 17.03.2018
 * Time: 0:42
 */

namespace fedornabilkin\redirect\actions;


use fedornabilkin\redirect\models\Redirect;
use fedornabilkin\redirect\models\RedirectVisits;

class ErrorAction extends \yii\web\ErrorAction
{
    private $_url;
    private $_r;

    CONST EVENT_BEFORE_RUN_REDIRECT = 'event_before_run_redirect';
    CONST EVENT_RESPONSE_REDIRECT = 'event_response_redirect';
    CONST EVENT_INSERT_REDIRECT = 'event_insert_redirect';
    CONST EVENT_AFTER_RUN_REDIRECT = 'event_after_run_redirect';

    public function init()
    {
        parent::init();

        $this->_url = \Yii::$app->request->url;
        $this->_r = \Yii::$app->request;
    }

    public function run()
    {
//        $this->trigger(self::EVENT_BEFORE_RUN_REDIRECT);
        $model = Redirect::findOne(['from' => $this->_url]);

        if($model){
            $model->updateCounters(['visited' => 1]);
            $this->_setVisit($model);

            if($model->to != ''){
//                $this->trigger(self::EVENT_RESPONSE_REDIRECT);
                return \Yii::$app->getResponse()->redirect($model->to, $model->status_code);
            }
        }
        elseif(!$model){
            $model = new Redirect();
            $model->from = $this->_url;
            if ($model->validate()) {
                $model->save();
                $this->_setVisit($model);
//                $this->trigger(self::EVENT_INSERT_REDIRECT);
            }
        }

//        $this->trigger(self::EVENT_AFTER_RUN_REDIRECT);
//        \Yii::$app->trigger(self::EVENT_AFTER_RUN_REDIRECT);
        return parent::run();
    }

    /**
     * @param $redirect Redirect
     */
    private function _setVisit($redirect)
    {
        $visit = new RedirectVisits();

        $load[$visit->formName()]['ip'] = $this->_r->userIP;
        $load[$visit->formName()]['agent'] = $this->_r->userAgent;
        $load[$visit->formName()]['referrer'] = $this->_r->referrer;

        $visit->load($load);
        $visit->link('redirect', $redirect);

    }
}
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
    private $url;
    private $r;

    CONST EVENT_BEFORE_RUN_REDIRECT = 'event_before_run_redirect';
    CONST EVENT_RESPONSE_REDIRECT = 'event_response_redirect';
    CONST EVENT_INSERT_REDIRECT = 'event_insert_redirect';
    CONST EVENT_AFTER_RUN_REDIRECT = 'event_after_run_redirect';

    public function init()
    {
        parent::init();

        $this->url = \Yii::$app->request->url;
        $this->r = \Yii::$app->request;
    }

    public function run()
    {
        $this->setTrigger(self::EVENT_BEFORE_RUN_REDIRECT);

        $from = $this->url;
        $model = Redirect::findOne(['from' => $from]);

        if($model){
            $model->updateCounters(['visited' => 1]);
            $this->setVisit($model);

            if($model->to != ''){
                $this->setTrigger(self::EVENT_RESPONSE_REDIRECT);
                return \Yii::$app->getResponse()->redirect($model->to, $model->status_code);
            }
        }
        elseif(!$model){
            $model = new Redirect();
            $model->from = $from;

            if ($model->validate() && $model->save()) {
                $this->setVisit($model);
                $this->setTrigger(self::EVENT_INSERT_REDIRECT);
            }
        }

        $this->setTrigger(self::EVENT_AFTER_RUN_REDIRECT);
        return parent::run();
    }

    /**
     * @param $redirect Redirect
     */
    protected function setVisit($redirect)
    {
        $visit = new RedirectVisits();

        $load[$visit->formName()]['ip'] = $this->r->userIP;
        $load[$visit->formName()]['agent'] = $this->r->userAgent;
        $load[$visit->formName()]['referrer'] = $this->r->referrer;

        $visit->load($load);
        $visit->link('redirect', $redirect);

    }

    protected function setTrigger($name)
    {
        $this->trigger($name);
    }
}

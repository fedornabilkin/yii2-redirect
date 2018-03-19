<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA-PC
 * Date: 17.03.2018
 * Time: 0:42
 */

namespace fedornabilkin\redirect\actions;


use fedornabilkin\redirect\models\Redirect;

class ErrorAction extends \yii\web\ErrorAction
{
    private $_url;

    public function init()
    {
        parent::init();

        $this->_url = \Yii::$app->request->url;
    }

    public function run()
    {
        $model = Redirect::findOne(['from' => $this->_url]);

        if($model && $model->to != ''){
            return \Yii::$app->getResponse()->redirect($model->to, $model->status_code);
        }elseif($model){
            $model->updateCounters(['visited' => 1]);
        }
        elseif(!$model){
            $model = new Redirect();
            $model->from = $this->_url;
            if ($model->validate()) {
                $model->save();
            }
        }

        return parent::run();
    }
}
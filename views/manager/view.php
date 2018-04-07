<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model fedornabilkin\redirect\models\Redirect */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('redirect', 'Redirects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redirect-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('redirect', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('redirect', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('redirect', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'from',
            'to',
            'status_code',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

    <h3><?=Yii::t('redirect', 'List visits')?></h3>

    <?php
    $dataProvider = new ArrayDataProvider([
        'key' => 'id',
        'allModels' => $model->visits,
        'sort' => [
            'attributes' => ['id'],
            'defaultOrder' => [
                'id' => SORT_DESC,
            ],
        ],
        'pagination' => [
            'pageSize' => 100,
        ],
    ]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'columns' => [
            'ip',
            [
                'attribute' => 'agent',
                'format' => 'html',
                'value' => function($data){
                    $date = date("H:i:s d.m.y", $data->created_at);
                    $referrer = Html::a($data->referrer, Url::to($data->referrer, true));
                    return $date . '<br><small>' . $data->agent . '</small><br><small>' . $referrer . '</small>';
                }
            ],
        ],
    ]);
    ?>

</div>

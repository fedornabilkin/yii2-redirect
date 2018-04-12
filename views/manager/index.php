<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel fedornabilkin\redirect\models\RedirectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('redirect', 'Redirects');
$this->params['breadcrumbs'][] = $this->title;

$frontendHost = Yii::$app->controller->module->frontendHost;
?>
<div class="redirect-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('redirect', 'Create redirect'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('redirect', 'Remove empty redirects'), ['delete-empty'], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('redirect', 'All records that are not redirected anywhere along with statistics of visits will be deleted. Remove?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],

            [
                'attribute' => 'visited',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a($data->visited, ['/redirect/manager/view', 'id' => $data->id]);
                }
            ],
            'status_code',
            [
                'attribute' => 'from',
                'format' => 'raw',
                'value' => function($data) use($frontendHost){
                    $url = Url::to($frontendHost . $data->from, true);
                    return Html::a($data->from, $url, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'to',
                'format' => 'raw',
                'value' => function($data) use($frontendHost){
                    $url = Url::to($frontendHost . $data->to, true);
                    return Html::a($data->to, $url, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:i d.m.y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:i d.m.y']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel fedornabilkin\redirect\models\RedirectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('redirect', 'Redirects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redirect-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('redirect', 'Create redirect'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],

            'visited',
            'status_code',
            [
                'attribute' => 'from',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a($data->from, $data->from, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'to',
                'format' => 'raw',
                'value' => function($data){
                    return Html::a($data->to, $data->to, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:H:m d.m.y']
            ],
            [
                'attribute' => 'updated_at',
                'format' => ['date', 'php:H:m d.m.y']
            ],
        ],
    ]); ?>
</div>

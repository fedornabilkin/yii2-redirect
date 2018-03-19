<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model fedornabilkin\redirect\models\Redirect */

$this->title = Yii::t('redirect', 'Update Redirect');
$this->params['breadcrumbs'][] = ['label' => Yii::t('redirect', 'Redirects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('redirect', 'Update');
?>
<div class="redirect-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

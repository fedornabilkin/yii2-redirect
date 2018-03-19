<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model fedornabilkin\redirect\models\Redirect */

$this->title = Yii::t('redirect', 'Create Redirect');
$this->params['breadcrumbs'][] = ['label' => Yii::t('redirect', 'Redirects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redirect-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

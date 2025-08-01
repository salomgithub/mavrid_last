<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\davlat */

$this->title = 'Update Davlat: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Davlats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="davlat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

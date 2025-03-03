<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Date */

$this->title = 'Update Date: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="date-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

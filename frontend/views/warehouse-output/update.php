<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\WarehouseOutput */

$this->title = 'Update Warehouse Output: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="warehouse-output-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

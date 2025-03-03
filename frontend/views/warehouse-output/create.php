<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\WarehouseOutput */

$this->title = 'Chiqim';
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container warehouse-output-create">


    <?= $this->render('_form', [
        'model' => $model,
        'materialsList' => $materialsList,
        'matretialsParams' => $matretialsParams,
        'status' => $status,
    ]) ?>

</div>

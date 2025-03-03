<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Warehouse */

$this->title = 'Tovarni ombordan chiqarish';
$this->params['breadcrumbs'][] = ['label' => 'Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">
    <?= Html::a('Ortga', ['index'], ['class' => 'btn btn-success']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tovarItems' => $tovarItems,
        'tovarParams' => $tovarParams,
    ]) ?>

</div>

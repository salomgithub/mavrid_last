<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\WarehouseInput */

$this->title = 'Kirim';
$this->params['breadcrumbs'][] = ['label' => 'Kirimlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container warehouse-input-create">



    <?= $this->render('_form', [
        'model' => $model,
        'materials' => $materials,
    ]) ?>

</div>

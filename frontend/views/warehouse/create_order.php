<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Warehouse */

$this->title = 'Ishchilardan buyurtma qabul qilish';
$this->params['breadcrumbs'][] = ['label' => 'Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-create">
    <?= Html::a('Ortga', ['index'], ['class' => 'btn btn-success']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_order', [
        'model' => $model,
        'xato' => $xato,
    ]) ?>

</div>

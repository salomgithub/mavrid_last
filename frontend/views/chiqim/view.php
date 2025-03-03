<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Warehouse */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Warehouses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="warehouse-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('ortga', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Barcha mavriddan kelgan tovarlar', ['indexin'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('tashqaridan kelgan tovarlar', ['indexout'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'order_id',
            [
                'attribute'=>'tovar_id',
                'value'=>function($model){
                    $value = $model->tovar_id;
                    $value = \frontend\models\Tovar::findOne($value);
                    $value = $value->name;
                    return $value;
                },
                'label'=>'Model'
            ],
            'soni',
            'create_data',
        ],
    ]) ?>

</div>

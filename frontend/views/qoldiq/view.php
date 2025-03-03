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
        <?= Html::a('Barcha mavriddan kelgan tovarlar', ['warehouse/indexin'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('tashqaridan kelgan tovarlar', ['warehouse/indexout'], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
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
            'update_data',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mavrid tovarlari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1>Mavrid tovarlari - Omborxona</h1>

    <p>
        <?= Html::a(' + Bozordan qabul qilish', ['create_tovar'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(' + Ishchilardan qabul qilish', ['create_order'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Barcha mavriddan kelgan tovarlar', ['indexin'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('tashqaridan kelgan tovarlar', ['indexout'], ['class' => 'btn btn-primary']) ?>

    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_id',
            [
                'attribute'=>'tovar_id',
                'filter'=>\yii\helpers\ArrayHelper::map(\frontend\models\Tovar::find()->all(),'id','name'),
                'value'=>'tovar.name',
                'label'=>'Model'
            ],
            'soni',
            'create_data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

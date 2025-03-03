<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qoldiq';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1>Qoldiq - Omborxona</h1>

    <p>
        <?= Html::a('  Omborxona', ['index'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Barcha mavriddan kelgan tovarlar', ['warehouse/indexin'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('tashqaridan kelgan tovarlar', ['warehouse/indexout'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' + Bozordan qabul qilish', ['warehouse/create_tovar'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(' + Ishchilardan qabul qilish', ['warehouse/create_order'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(' - Chiqim ', ['chiqim/index'], ['class' => 'btn btn-danger']) ?>
        <?= Html::a(' - Hisobot ', ['report/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            [
                'attribute'=>'tovar_id',
                'filter'=>\yii\helpers\ArrayHelper::map(\frontend\models\Tovar::find()->all(),'id','name'),
                'value'=>'tovar.name',
                'label'=>'Model'
            ],
            'soni',
            [
//                'attribute'=>'Kirim soni',
//                'filter'=>\yii\helpers\ArrayHelper::map(\frontend\models\Tovar::find()->all(),'id','name'),
                'value'=>function($model){
                    $chiqim = \frontend\models\Warehouse::find()->where(['tovar_id'=>$model->tovar_id])->sum('soni');
                    return $chiqim;
                },
                'label'=>'Buyurtma kirim',
            ],
            [
                'attribute'=>'Kirim soni',
//                'filter'=>\yii\helpers\ArrayHelper::map(\frontend\models\Tovar::find()->all(),'id','name'),
                'value'=>function($model){
                    $chiqim = \frontend\models\Warehouseout::find()->where(['tovar_id'=>$model->tovar_id])->sum('soni');
                    return $chiqim;
                },
                'label'=>'Tashqaridan kirim'
            ],
            [
                'attribute'=>'Chqim soni',
//                'filter'=>\yii\helpers\ArrayHelper::map(\frontend\models\Tovar::find()->all(),'id','name'),
                'value'=>function($model){
                    $chiqim = \frontend\models\Chiqim::find()->where(['tovar_id'=>$model->tovar_id])->sum('soni');
                    return $chiqim;
                },
                'label'=>'Chiqimlar'
            ],
//            'update_data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

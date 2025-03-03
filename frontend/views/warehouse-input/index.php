<?php

use frontend\models\Materials;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseInputSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kirim';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-input-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->



    <?php  echo $this->render('_search', ['model' => $searchModel, 'materials'=> $materials]); ?>
    <p>
        <?= Html::a('Kirim  ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'material_id',
            [
                'attribute' => 'material_id',
                // 'filter' => false,
                // 'filter' => ArrayHelper::map(Materials::find()->all(), 'id', 'name'),
                'value' => function($model) {
                    return $model->material_id ? Materials::findOne($model->material_id)->name : null;
                },
            ],
            'price',
            'summa',
            'from_name',
            'quantity',
            'date_received',
            'storage_location',
            //'comments:ntext',
            'created_at',
            'updated_at',
            // 'status',
            // [
            //     'attribute' => 'status',
            //     'format' => 'raw',  // 'raw' format tugmalarni ko'rsatish uchun kerak
            //     'value' => function ($model) {
            //         if ($model->status == 0) {
            //             return Html::a('Tasdiqlash', ['warehouse-input/status', 'id' => $model->id], [
            //                 'class' => 'btn btn-success',
            //                 'data' => [
            //                     'confirm' => 'Siz bu elementni tasdiqlamoqchimisiz?',
            //                     'method' => 'post',
            //                 ],
            //             ]);
            //         } elseif ($model->status == 10) {
            //             return '<span class="label label-success">Tasdiqlangan</span>';
            //         }
            //     },
            // ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

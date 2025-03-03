<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Materials;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseOutputSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chiqim';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-output-index">

    <h1><? //echo Html::encode($this->title) ?></h1>



    <?php  echo $this->render('_search', ['model' => $searchModel, 'materials'=> $materials]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'material_id',
            [
                'attribute' => 'material_id',
                // 'filter' => false,
                // 'filter' => ArrayHelper::map(Materials::find()->all(), 'id', 'name'),
                'value' => function($model) {
                    return $model->material_id ? Materials::findOne($model->material_id)->name : null;
                },
            ],
            'quantity',
            'date_of_exit',
            // 'destination',
             [
                'attribute' => 'destination',
                // 'filter' => false,
                // 'filter' => ArrayHelper::map(Materials::find()->all(), 'id', 'name'),
                'value' => function($model) {
                    switch ($model->destination) {
                        case '1':
                            $name = "Bichish";
                            break;
                        case '2':
                            $name = "Tikish";
                            break;
                        case '3':
                            $name = "Taqsimot";
                            break;
                        default:
                            $name = "nomalum";
                            break;
                    }
                    return $name;
                    // return $model->destination ? Materials::findOne($model->material_id)->name : null;
                },
            ],
            //'comments:ntext',
            'created_at',
            //'updated_at',
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

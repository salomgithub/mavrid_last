<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseOutputSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bichish';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-output-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Warehouse Output', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'material_id',
            'quantity',
            'date_of_exit',
            'destination',
            //'comments:ntext',
            //'created_at',
            //'updated_at',
            'status',
            [
                'attribute' => 'status',
                'format' => 'raw',  // 'raw' format tugmalarni ko'rsatish uchun kerak
                'value' => function ($model) {
                    if ($model->status == 0) {
                        return Html::a('Tasdiqlash', ['bichish/status', 'id' => $model->id], [
                            'class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Siz bu elementni tasdiqlamoqchimisiz?',
                                'method' => 'post',
                            ],
                        ]);
                    } elseif ($model->status == 10) {
                        return '<span class="label label-success">Tasdiqlangan</span>';
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

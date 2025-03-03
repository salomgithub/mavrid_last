<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tashqari';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1>Barcha ko'chadan kirim bo'lgan tovarlar</h1>

    <p>
        <?= Html::a('  Omborxona', ['qoldiq/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Barcha mavriddan kelgan tovarlar', ['indexin'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('tashqaridan kelgan tovarlar', ['indexout'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(' + Bozordan qabul qilish', ['create_tovar'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(' + Ishchilardan qabul qilish', ['create_order'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(' - Chiqim ', ['chiqim/index'], ['class' => 'btn btn-danger']) ?>
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
            'create_data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

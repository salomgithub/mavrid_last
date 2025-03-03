<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Omborxona';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(' - Tovarni ombordan chiqarish', ['chiqim'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('tashqaridan kelgan tovarlar', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Qoldiq', ['qoldiq'], ['class' => 'btn btn-danger']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',

            'tovar_id',
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

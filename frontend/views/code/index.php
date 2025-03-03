<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\models\Tovar;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="code-index">

    <h1><?= Html::encode($this->title) ?></h1>

        <?= Html::a('Yangi operatsiya qo`shish', ['create'], ['class' => 'btn btn-success']) ?>

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
                'filter'=>ArrayHelper::map(Tovar::find()->all(),'id','name'),
                'value'=>'tovar.name'
            ],
            'code',
            'price',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

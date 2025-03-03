<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OylikSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Oyliks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oylik-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Oylik', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'employee_id',
            'code_summa',
            'summa',
            'data',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

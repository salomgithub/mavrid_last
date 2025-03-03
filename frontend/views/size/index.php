<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\SizeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sizes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="size-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Size', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'size',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

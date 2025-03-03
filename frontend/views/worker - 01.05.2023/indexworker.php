<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\models\Employees;
use frontend\models\Code;

$this->title = 'Workers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-index">


    <p>
        <?= Html::a('+', ['createworker'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => 
        [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'order_id',
            // 'code_id',
            [
                'attribute'=>'code_id',
                // 'filter'=>ArrayHelper::map(Employees::find()->all(),'lastname', 'id'),
                'value'=>function($model){
                    $data = \frontend\models\Code::findOne(['id'=>$model->code_id]);
                    return $data->code;
                }
            ],
            [
                'attribute'=>'employee_id',
                // 'filter'=>ArrayHelper::map(Employees::find()->all(),'lastname', 'id'),
                'value'=>'employees.lastname'
            ],
            'soni',
            'date',

        ],
    ]); ?>


</div>

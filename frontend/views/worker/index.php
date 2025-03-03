<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\models\Employees;
use frontend\models\Code;
use kartik\export\ExportMenu;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WorkerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Workers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Worker', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

<?php


    $gridColumns = [

            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'employee_id',
                'filter'=>ArrayHelper::map(Employees::find()->all(),'id','lastname'),
                'value'=>'employees.lastname'
            ],
            [
                'attribute'=>'employee_id',
                // 'filter'=>ArrayHelper::map(Employees::find()->all(),'id','firstname'),
                'value'=>'employees.firstname'
            ],
            'employee_id',
            'order_id',
            'code_id',
            [
                'attribute'=>'code_id',
                'filter'=>ArrayHelper::map(Code::find()->all(),'id','code'),
                'value'=>'code.code'
            ],
            'soni',
            [
                'attribute'=>'date',
                'filter'=>DatePicker::widget([
                    'model'=>$searchModel,
                    'attribute'=>'date',
                    'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => [
            'class'=> 'form-control',
            'autocomplete'=>'off'
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
            'yearRange' => '2021:2023',
            // 'showOn' => 'button',
            // 'buttonText' => 'Выбрать дату',
            //'buttonImageOnly' => true,
            //'buttonImage' => 'images/calendar.gif'
        ]
                ])
            ],
            'narxi',

  //          ['class' => 'yii\grid\ActionColumn'],

        // ['class' => 'yii\grid\ActionColumn'],
    ];

    // // Renders a export dropdown menu
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);


?>
    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' =>
        [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'order_id',

            // 'code_id',
//            'employee_id',

            [
            'attribute'=>'employee_id',
//                'filter'=>ArrayHelper::map(Employees::find()->all(),'id','lastname'),
                'value'=>'employees.lastname'
            ],
            [
            'attribute'=>'employee_id',
                'filter'=>ArrayHelper::map(Employees::find()->all(),'id','firstname'),
                'value'=>'employees.firstname',
                'label'=>'Ism'
            ],

            // [
            //     'attribute'=>'employee_id',
            //     'filter'=>ArrayHelper::map(Employees::find()->all(),'lastname', 'id'),
            //     'value'=>'employees.firstname'
            // ],

            [
                'attribute'=>'code_id',
                'filter'=>ArrayHelper::map(Code::find()->all(),'id','code'),
                'value'=>'code.code'
            ],
            'soni',
            'date',
            'narxi',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

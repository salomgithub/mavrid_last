<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\WorkerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="worker-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'begin_date')->widget(DatePicker::class, [
        'model'=>$model,
        'attribute'=>'begin_date',
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => [
            'placeholder' => date('d.m.Y',$model->begin_date??time()),
            'class'=> 'form-control',
            'autocomplete'=>'off'
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
            'yearRange' => '2021:2023',
        ]
    ]); ?>

 <?= $form->field($model, 'end_date')->widget(DatePicker::class, [
        'model'=>$model,
        'attribute'=>'end_date',
        'language' => 'ru',
        'dateFormat' => 'dd.MM.yyyy',
        'options' => [
            'placeholder' => date('d.m.Y',$model->begin_date??time()),
            'class'=> 'form-control',
            'autocomplete'=>'off'
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
            'yearRange' => '2021:2023',
        ]
    ]);

     ?>



    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

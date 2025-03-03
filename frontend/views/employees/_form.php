<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
// use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'namefather')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'pasport')->textInput(['maxlength' => true]) ?>

    
    <?= $form->field($model,'date')->widget(DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy.MM.dd',
        'options' => [
            'placeholder' => Yii::$app->formatter->asDate($model->date),
            'class'=> 'form-control',
            'autocomplete'=>'off'
        ],
        'clientOptions' => [
            'changeMonth' => true,
            'changeYear' => true,
            'yearRange' => '1975:2020',
            // 'showOn' => 'button',
            // 'buttonText' => 'Выбрать дату',
            //'buttonImageOnly' => true,
            //'buttonImage' => 'images/calendar.gif'
        ]
    ])->textInput(['placeholder' => 'Tug`ilgan sana']) ?>



    <?= $form->field($model, 'start_work')->textInput()->widget(DatePicker::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy.MM.dd',
        'options' => [
            'placeholder' => Yii::$app->formatter->asDate($model->start_work),
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
    ])->textInput(['placeholder' => 'Ishga kirgan sana']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

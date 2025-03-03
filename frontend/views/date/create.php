<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use frontend\models\Employees;
use frontend\models\Worker;
use frontend\models\Date;
use yii\jui\DatePicker as DatePickerAlias;
// use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $model = new Date(); ?>

    <?= $form->field($model,'from_date')->widget(DatePickerAlias::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy.MM.dd',
        'options' => [
            'placeholder' => Yii::$app->formatter->asDate($model->from_date),
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
    ])->textInput(['placeholder' => 'Boshlang`ich sanani tanlang'])->label("Boshlang`ich sana") ?>

    <?= $form->field($model,'to_date')->widget(DatePickerAlias::class, [
        'language' => 'ru',
        'dateFormat' => 'yyyy.MM.dd',
        'options' => [
            'placeholder' => Yii::$app->formatter->asDate($model->to_date),
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
    ])->textInput(['placeholder' => 'Oxirgi sanani tanlang'])->label("Oxirgi sana") ?>

<!--        echo $form->field($model,'from_date')->textInput(['placeholder' => 'start data']);-->
<!---->
<!--        echo $form->field($model,'to_date')->textInput(['placeholder' => 'end data']);-->
<!---->
<!--    ?>-->


    <div class="form-group">
        <?= Html::submitButton('Hisoblash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


</div>

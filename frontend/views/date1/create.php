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
    
    <?php echo $form->field($model,'from_date')->widget(DatePicker::class, [
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
    ])->textInput(['placeholder' => 'Tug`ilgan sana'])." ".

    $form->field($model,'to_date')->widget(DatePicker::class, [
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
    ])->textInput(['placeholder' => 'Tug`ilgan sana']); ?>


    <div class="form-group">
        <?= Html::submitButton('Hisoblash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    
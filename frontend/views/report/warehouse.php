<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\jui\DatePicker as DatePickerAlias;
// use kartik\date\DatePicker;
//$this->title = 'Omborxona Monitoringi';
/* @var $this yii\web\View */
/* @var $model frontend\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>
<h1>Omborxonaga kirim bo'lgan buyurtmalar  va yaroqsiz tovarlar hisoboti</h1>
<div class="employees-form">

<?php $form = ActiveForm::begin(); ?>

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

<!--   --><?php //echo $form->field($model,'from_date')->textInput();

//    echo $form->field($model,'to_date')->textInput();?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>

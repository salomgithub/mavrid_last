<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

<table>
    <tr>
        <td>
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
        </td>
        <td>
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
        </td>
        <td>
            <div class="form-group">
                &nbsp<label for="">qidirish</label><br>
                &nbsp<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>

                <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </td>
    </tr>
</table>

    <?php // echo $form->field($model, 'brak_soni') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'status') ?>



    <?php ActiveForm::end(); ?>

</div>

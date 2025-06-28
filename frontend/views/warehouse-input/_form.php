<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WarehouseInput */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-input-form container mt-4">

    <h3 class="text-center mb-4">Kirim qilish</h3>

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'material_id')->dropDownList($materials, [
            'prompt' => 'Укажите Tovar',
        ])->label('Tovar') ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'price')->textInput([
            'maxlength' => true,
            'type' => 'number',
            'class' => 'form-control'
        ]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'quantity')->textInput([
            'maxlength' => true,
            'type' => 'number',
            'class' => 'form-control'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'date_received')->textInput([
            'type' => 'date',
            'value' => !empty($model->date_received) ? date('Y.m.d', strtotime($model->date_received)) : '',
            'class' => 'form-control'
        ]) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'from_name')->textInput([
            'maxlength' => true,
            'value'=>'1',
            'class' => 'form-control'
        ]) ?>
    </div>
    
    <div class="col-md-6">
        <?= $form->field($model, 'storage_location')->textInput([
            'maxlength' => true,
            'value'=>'Asosiy ombor',
            'class' => 'form-control'
        ]) ?>
    </div>

    <div class="col-md-12">
        <?= $form->field($model, 'comments')->textarea([
            'rows' => 4,
            'class' => 'form-control'
        ]) ?>
    </div>

    <div class="col-md-12 text-center">
        <?= Html::submitButton('Kirim qilish', ['class' => 'btn btn-success btn-lg px-5']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


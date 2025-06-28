<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WarehouseOutputSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-output-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-3">
           <?= $form->field($model, 'material_id')->dropDownList($materials, [
            'prompt' => 'Укажите Tovar',
        ])->label('Tovar') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'quantity') ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'destination') ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'date_of_exit')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-md-1">
            <div class="form-group"><br>
                <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>

            </div>
        </div>
    </div>
    

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

 
    <?php ActiveForm::end(); ?>

</div>

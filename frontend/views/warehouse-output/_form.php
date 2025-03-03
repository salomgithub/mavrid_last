<?php

use frontend\models\WarehouseInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\WarehouseOutput */
/* @var $form yii\widgets\ActiveForm */


//echo "<pre>";
//print_r($materialsItems); die();

?>

<div class="container mt-4 warehouse-output-form">

    <h3 class="text-center mb-4">Warehouse Input Form</h3>

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6">
        <?= $form->field($model, 'material_id')->dropDownList($materialsList, [
            'prompt' => 'Укажите Tovar',
        ])->label('Tovar') ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'quantity')->textInput([
            'maxlength' => true,
            'type' => 'number',
            'class' => 'form-control'
        ]) ?>
    </div>

    <div class="col-md-2">
        <?= $form->field($model, 'date_of_exit')->textInput([
            'type' => 'date',
            'value' => !empty($model->date_received) ? date('Y.m.d', strtotime($model->date_received)) : ''
        ]) ?>
    </div>

    <div class="col-md-4">
        <?= $form->field($model, 'destination')->dropDownList(['1' => 'Bichish', '2' => 'Tikish', '3' => 'Taqsimot']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>
    </div>
    <div class="col-md-12 text-center">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-lg px-5']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<!-- Modalni ochish tugmasi -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
    Add Warehouse Input
</button>

<!-- Modal oynasi -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Warehouse Input Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formani shu yerga joylashtiring -->
                <?php $form = ActiveForm::begin(); ?>

                <div class="form-group">
                    <?= $form->field($model, 'material_id')->dropDownList($materialsList, [
                        'prompt' => 'Укажите Tovar',
                    ])->label('Tovar') ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'quantity')->textInput([
                        'maxlength' => true,
                        'type' => 'number',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'date_of_exit')->textInput([
                        'type' => 'date',
                        'value' => !empty($model->date_received) ? date('Y.m.d', strtotime($model->date_received)) : ''
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'destination')->dropDownList(['1' => 'Bichish', '2' => 'Tikish', '3' => 'Taqsimot']) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


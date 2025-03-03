<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WarehouseInputSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-input-search">

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
            <?= $form->field($model, 'quantity')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'date_received')->textInput(['type' => 'date']) ?>
        </div>
        <div class="col-md-3">
            <div class="form-group"><br>
                <?= Html::submitButton('Qidirish', ['class' => 'btn btn-primary']) ?>

            </div>
        </div>
    </div>



    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bichish */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bichish-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'material_id')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'qavat')->textInput() ?>

    <?= $form->field($model, 'soni')->textInput() ?>

    <?= $form->field($model, 'umumiy_soni')->textInput() ?>

    <?= $form->field($model, 'kroy')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

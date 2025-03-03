<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Oylik */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oylik-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

    <?= $form->field($model, 'code_summa')->textInput() ?>

    <?= $form->field($model, 'summa')->textInput() ?>

    <!-- <?= $form->field($model, 'data')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

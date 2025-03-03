<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\MaterialType;
use yii\helpers\ArrayHelper;

$type = ArrayHelper::map(MaterialType::find()->all(), 'id', 'name');
 
/* @var $this yii\web\View */
/* @var $model frontend\models\Materials */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materials-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList($type, [
            'prompt' => 'Укажите Tovar',
        ])->label('Tovar') ?>
    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit')->dropDownList([ 'metr' => 'Metr', 'kg' => 'Kg', 'litr' => 'Litr', 'dona' => 'Dona', ], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

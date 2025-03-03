<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Employees;
use yii\helpers\ArrayHelper;
use frontend\models\Orders;
use frontend\models\Code;

/* @var $this yii\web\View */
/* @var $model frontend\models\Warehouse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->textInput(['onchange'=> '
                $.post( "index.php?r=warehouse%2Flisttovar&id='.'"+$(this).val(), function (data){
                $("select#warehouse-tovar_id").html(data);
            });
            $.post( "index.php?r=worker%2Flisttovar&id='.'"+$(this).val(), function (data){
                $("select#worker-name").html(data);
            });'
    ]); ?>


    <?= $form->field($model, 'tovar_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->dropDownList(
        [
            'prompt'  => 'tanlang....',
        ]); ?>


    <?= $form->field($model, 'soni', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'2']])->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
<h1>
    <?=$xato?>
</h1>
    <?php ActiveForm::end(); ?>

</div>

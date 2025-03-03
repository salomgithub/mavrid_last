<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\Employees;
use yii\helpers\ArrayHelper;
use frontend\models\Orders;
use frontend\models\Code;

/* @var $this yii\web\View */
/* @var $model frontend\models\Worker */
/* @var $form yii\widgets\ActiveForm */
?>

<?php


?>
<b align="right">
    <?= Html::a('Barcha ishlarni ko`rish', ['indexworker'], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Tozalash', ['createworker'], ['class' => 'btn btn-danger']) ?>
</b>
    <h3 align="center"><?= Html::encode($this->title) ?></h3>
<div class="worker-form">
    <?php echo $xabar ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->textInput(['onchange'=> '
                $.post( "index.php?r=worker%2Flist&id='.'"+$(this).val(), function (data){
                $("select#worker-code_id").html(data);
            });
            $.post( "index.php?r=worker%2Flisttovar&id='.'"+$(this).val(), function (data){
                $("select#worker-name").html(data);
            });'
        ]); ?>
        
        <label class="control-label">Maxsulot nomi</label>
        <select class="form-control" id="worker-name">
            <option>Buyurtma tanlanmagan</option>
        </select><br>

    <?= $form->field($model, 'code_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->dropDownList(
        [
            'prompt'  => 'tanlang....',
        ]); ?>
    <?= $form->field($model, 'soni', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'4']])->textInput() ?>

    <!-- <?= $form->field($model, 'date')->textInput() ?> -->

    <div class="form-group">
        <h3 align="center">
            
        <?= Html::submitButton('___ S  A  Q  L  A  SH  ___', ['class' => 'btn btn-success', 'tabindex'=>'5']) ?>
        
        </h3>
    </div>

    <?php ActiveForm::end(); ?>



</div>

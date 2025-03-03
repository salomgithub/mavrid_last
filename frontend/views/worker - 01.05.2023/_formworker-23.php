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

<div class="worker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'order_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->dropDownList(ArrayHelper::map(Orders::find()->orderBy('id DESC')->limit(500)->all(),'id','id'),
        [
            'prompt'  => 'tanlang....',
            'onchange'=> '
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

    <?= $form->field($model, 'code_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->dropDownList(ArrayHelper::map(Code::find()->all(),'id','code'),
        [
            'prompt'  => 'tanlang....',
        ]); ?>
    <?= $form->field($model, 'soni', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'4']])->textInput() ?>

    <!-- <?= $form->field($model, 'date')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php echo $xabar ?>

</div>

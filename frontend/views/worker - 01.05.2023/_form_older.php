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
    // $userBranch_id = UserModel::findOne($_SESSION['viloyat']);
    // $region = $userBranch_id['region_id'];
    $worker = Employees::find()->all();
    $workerItems = ArrayHelper::map($worker,'id','lastname');
    $workerParams = [
        'prompt' => 'ishchini tanlang'
   ];

    $order = Orders::find()->all();
    $orderItems = ArrayHelper::map($order,'id','id',);
    $orderParams = [
        'prompt' => 'Укажите Buyurtma №'
    ];

    $code = Code::find()->all();
    $codeItems = ArrayHelper::map($code,'id','code');
    $codeParams = [
        'prompt' => 'Укажите Operatsiya turi'
    ];


?>

<div class="worker-form">

    <?php $form = ActiveForm::begin(); ?>


    
    <?= $form->field($model, 'order_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'1']])->dropDownList($orderItems,$orderParams)->label('Buyurtma №',['class'=>'tc']) ?>

    <?= $form->field($model, 'employee_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'2']])->dropDownList($workerItems,$workerParams)->label('Hodim Fio',['class'=>'tc']) ?>
    
    <?= $form->field($model, 'code_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'3']])->dropDownList($codeItems,$codeParams)->label('Operatsiya turi',['class'=>'tc']) ?>

    <?= $form->field($model, 'soni', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'4']])->textInput() ?>

    <!-- <?= $form->field($model, 'date')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

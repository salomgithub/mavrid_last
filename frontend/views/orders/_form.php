<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Tovar;
use frontend\models\Color;
use frontend\models\Size;

/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<?php 
    // $userBranch_id = UserModel::findOne($_SESSION['viloyat']);
    // $region = $userBranch_id['region_id'];
    $tovar = Tovar::find()->all();
    $tovarItems = ArrayHelper::map($tovar,'id','name');
    $tovarParams = [
        'prompt' => 'Укажите Tovar'
   ];

    $color = Color::find()->all();
    $colorItems = ArrayHelper::map($color,'id','color');
    $colorParams = [
        'prompt' => 'Укажите Rangi'
    ];

    $size = Size::find()->all();
    $sizeItems = ArrayHelper::map($size,'id','size');
    $sizeParams = [
        'prompt' => 'Укажите O`lchami'
    ];


?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'id')->textInput() ?> -->

    <?= $form->field($model, 'tovar_id')->dropDownList($tovarItems,$tovarParams)->label('Tovar',['class'=>'tc']) ?>
    
    <?= $form->field($model, 'color_id')->dropDownList($colorItems,$colorParams)->label('Rangi',['class'=>'tc']) ?>
    
    <?= $form->field($model, 'size_id')->dropDownList($sizeItems,$sizeParams)->label('O`lchami',['class'=>'tc']) ?>

    <?= $form->field($model, 'soni')->textInput() ?>

    <!-- <?= $form->field($model, 'brak_soni')->textInput() ?> -->

    <!-- <?= $form->field($model, 'date')->textInput() ?> -->

    <!-- <?= $form->field($model, 'status')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

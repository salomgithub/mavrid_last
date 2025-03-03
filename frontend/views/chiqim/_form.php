<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Warehouse */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
//$tovar = \frontend\models\Tovar::find()->orderBy(['name' => SORT_ASC])->all();
//$tovar = \frontend\models\Qoldiq::find()->all();



?>

<div class="warehouse-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tovar_id', ['inputOptions'=>['class' =>'form-control', 'tabindex'=>'3']])->dropDownList($tovarItems,$tovarParams)?>

    <?= $form->field($model, 'soni')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

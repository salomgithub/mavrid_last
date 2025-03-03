<?php

use frontend\models\Bichish;
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\WarehouseInput;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\WarehouseOutput */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Warehouse Outputs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="warehouse-output-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <!-- Jadval va forma uchun container -->
    <div class="row">
        <!-- Jadval qismi -->
        <div class="col-md-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'material_id',
                    'quantity',
                    'date_of_exit',
                    'destination',
                    'comments:ntext',
                    'created_at',
                    'updated_at',
                ],
            ]) ?>
        </div>

        <!-- Forma qismi -->
        <div class="col-md-6">
            <?php
            $id = $model->id;
            $bichish = new Bichish();
            $bichish->material_id = $model->material_id;
            $bichish->quantity = $model->quantity;
            $bichish->color = "qora";
            $model = $bichish;
            ?>

            <div class="warehouse-output-form">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'material_id')->textInput() ?>
                <?= $form->field($model, 'quantity')->textInput() ?>
                <?= $form->field($model, 'color')->textInput() ?>
                <?= $form->field($model, 'qavat')->textInput() ?>
                <?= $form->field($model, 'soni')->textInput() ?>
                <?= $form->field($model, 'umumiy_soni')->textInput() ?>
                <?= $form->field($model, 'kroy')->textInput() ?>
                <?= $form->field($model, 'status')->textInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>


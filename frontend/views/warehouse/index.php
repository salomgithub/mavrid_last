<?php

use frontend\models\WarehouseInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

?>
<style>
    /* Umumiy konteyner grid */
    .container-grid {
        display: grid;
        grid-template-rows: 1fr 1fr; /* Monitoring yuqori va kirim-chiqim pastki qism */
        height: 100vh; /* Sahifaning butun balandligini qoplaydi */
        grid-template-columns: 1fr 1fr; /* Kirim va chiqim qismlarini yonma-yon qilish */
    }

    /* Monitoring qismi */
    .monitoring {
        grid-column: 1 / 3; /* Monitoring qismi ikkala ustunni ham qoplaydi */
        background-color: #f8f9fa;
        padding: 15px;
        height: 50vh; /* Monitoring qismi balandligi */
        resize: vertical; /* Vertikal o'lchamni o'zgartirish imkoniyati */
        overflow: auto;
    }

    /* Kirim va Chiqim qismlari */
    .kirim, .chiqim {
        padding: 15px;
        resize: vertical; /* Har birini mustaqil vertikal o'zgartirish */
        overflow: auto;
        min-height: 50%; /* Minimal balandlik 50% */
        height: auto;
        box-sizing: border-box;
    }

    /* Kirim chap tomonda */
    .kirim {
        grid-column: 1 / 2;
        background-color: #e9ecef;
    }

    /* Chiqim o'ng tomonda */
    .chiqim {
        grid-column: 2 / 3;
        background-color: #dee2e6;
    }

    /* Jadval */
    table {
        width: 100%;
        margin-bottom: 15px;
    }

    /* Resize uchun belgi */
    .resize-handle {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 20px;
        height: 20px;
        background: #ccc;
        cursor: se-resize;
    }
</style>
<br>
<div class="container-grid">
    <!-- Monitoring qismi -->
    <div class="monitoring">
        <h2>Monitoring</h2>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>№</th>
                <th>Mahsulot nomi</th>
                <th>Rangi</th>
                <th>Jami kirim</th>
                <th>Jami chiqim</th>
                <th>Qolgan miqdor</th>
                <th>Oxirgi o'zgarish</th>
            </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
            <?php foreach ($data_monitoring as $row): ?>
                <tr>
                    <td><?echo $i; $i++;?></td>
                    <td><?= $row['material_name'] ?></td>
                    <td><?= $row['color'] ?></td>
                    <td><?= $row['total_in'] ?></td>
                    <td><?= $row['total_out'] ?></td>
                    <td><?= $row['total_stock'] ?></td>
                    <td><?= $row['updated_at'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Kirim qismi -->
    <div class="kirim">
        <p style="font-size:35px; margin: -5px -5px -3px  ">Kirimlar
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalKirim">
                +
            </button>

            <?= Html::a('batafsil', ['warehouse-input/index'], ['class' => 'btn btn-info']) ?>
        </p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>№</th>
                <th>Mahsulot nomi</th>
                <th>Miqdor</th>
                <th>Operatsiya vaqti</th>
            </tr>
            </thead>
            <tbody>
                 <?php $i=1;?>
            <?php foreach ($data_in as $row): ?>
                <tr>
                    <td><?echo $i; $i++;?></td>
                    <td><?= \frontend\models\Materials::findOne($row->material_id)->name ?></td>
                    <td><?= $row->quantity ?></td>
                    <td><?= $row->created_at ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Chiqim qismi -->
    <div class="chiqim">
        <p style="font-size:35px; margin: -5px -5px -3px  ">Chiqimlar
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalChiqim">
                --
            </button>

            <?= Html::a('batafsil', ['warehouse-output/index'], ['class' => 'btn btn-info']) ?>
        </p>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>№</th>
                <th>Mahsulot nomi</th>
                <th>Miqdor</th>
                <th>Qayerga</th>
                <th>Chiqim sanasi</th>
                <th>Chiqim sanasi</th>
            </tr>
            </thead>
            <tbody>
                <?php $i=1;?>
            <?php foreach ($data_out as $row): ?>
                <?php
                $count = 0;
                $count = \frontend\models\WarehouseOutput::find()
                    ->where(['material_id' => $row->id,'status' => 0])
                    ->count();
                $style= "";
                if ($count >= 1) {
                    $style = ' style="background-color: yellow;"';
                }
                ?>
                <tr >
                    <td><?echo $i; $i++;?></td>

                    <td <?= $style ?> ><?=  \frontend\models\Materials::findOne($row->material_id)->name ?></td>
                    <td><?= $row->quantity ?></td>
                    <td><?= $row->destination ?></td>
                    <td><?= $row->date_of_exit ?></td>
                    <td><?= $row->created_at ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- Kirim formasi -->
<div class="modal fade" id="myModalKirim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Kirim qilish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <?php $form = ActiveForm::begin([
                    'action' => ['kirim'], // URL-ni ko'rsating
                    'method' => 'post', // POST metodini qo'llash
                ]); ?>
                <div class="form-group">
                    <?= $form->field($model_input, 'material_id')->dropDownList($tovars, [
                        'prompt' => 'Укажите Tovar',
                    ])->label('Tovar') ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModalAddTovar">
                        +
                    </button>
                </div>

                <div class="form-group">
                    <?= $form->field($model_input, 'price')->textInput([
                        'maxlength' => true,
                        'type' => 'number',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_input, 'quantity')->textInput([
                        'maxlength' => true,
                        'type' => 'number',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_input, 'date_received')->textInput([
                        'type' => 'date',
                        'value' => !empty($model_input->date_received) ? date('Y.m.d', strtotime($model_input->date_received)) : '',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_input, 'from_name')->textInput([
                        'maxlength' => true,
                        'value' => '1',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_input, 'storage_location')->textInput([
                        'maxlength' => true,
                        'value' => 'Asosiy ombor',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_input, 'comments')->textarea([
                        'rows' => 4,
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Chiqim oynasi -->
<div class="modal fade" id="myModalChiqim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Chiqim qilish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <!-- Formani shu yerga joylashtiring -->
                <?php $form = ActiveForm::begin([
                    'action' => ['chiqim'], // URL-ni ko'rsating
                    'method' => 'post', // POST metodini qo'llash
                ]); ?>

                <div class="form-group">
                    <?= $form->field($model_output, 'material_id')->dropDownList($materialsList, [
                        'prompt' => 'Укажите Tovar',
                    ])->label('Tovar') ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_output, 'quantity')->textInput([
                        'maxlength' => true,
                        'type' => 'number',
                        'class' => 'form-control'
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_output, 'date_of_exit')->textInput([
                        'type' => 'date',
                        'value' => !empty($model_output->date_received) ? date('Y.m.d', strtotime($model_output->date_received)) : ''
                    ]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_output, 'destination')->dropDownList(['1' => 'Bichish', '2' => 'Tikish', '3' => 'Taqsimot']) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_output, 'comments')->textarea(['rows' => 6]) ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<!-- yangi mahsulot qo'shish oynasi -->
<div class="modal fade" id="myModalAddTovar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Chiqim qilish</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formani shu yerga joylashtiring -->
                <?php $form = ActiveForm::begin([
                    'action' => ['add-new-tovar'], // URL-ni ko'rsating
                    'method' => 'post', // POST metodini qo'llash
                ]); ?>

                <div class="form-group">
                    <?= $form->field($model_add_tovar, 'name')->textInput(['maxlength' => true]) ?>

                </div>

                <div class="form-group">
                    <?= $form->field($model_add_tovar, 'type')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_add_tovar, 'color')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model_add_tovar, 'unit')->dropDownList(['metr' => 'Metr', 'kg' => 'Kg', 'litr' => 'Litr', 'dona' => 'Dona',], ['prompt' => '']) ?>

                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

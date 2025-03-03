<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Warehouse */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="warehouse-form">

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Mahsulot nomi</th>
            <th>Jami kirim</th>
            <th>Jami chiqim</th>
            <th>Qolgan miqdor</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['total_input'] ?></td>
                <td><?= $row['total_output'] ?></td>
                <td><?= $row['available_stock'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>


</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Oylik */

$this->title = 'Update Oylik: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Oyliks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="oylik-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Size */

$this->title = 'Update Size: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sizes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="size-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

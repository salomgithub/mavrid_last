<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\davlat */

$this->title = 'Create Davlat';
$this->params['breadcrumbs'][] = ['label' => 'Davlats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="davlat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

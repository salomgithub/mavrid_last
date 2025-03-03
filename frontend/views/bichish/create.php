<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Bichish */

$this->title = 'Create Bichish';
$this->params['breadcrumbs'][] = ['label' => 'Bichishes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bichish-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

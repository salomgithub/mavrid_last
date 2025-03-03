<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Citees */

$this->title = 'Create Citees';
$this->params['breadcrumbs'][] = ['label' => 'Citees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="citees-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Oylik */

$this->title = 'Create Oylik';
$this->params['breadcrumbs'][] = ['label' => 'Oyliks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="oylik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

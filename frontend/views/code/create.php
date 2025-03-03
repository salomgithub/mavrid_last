<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Code */

$this->title = 'Yangi operatsiya yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

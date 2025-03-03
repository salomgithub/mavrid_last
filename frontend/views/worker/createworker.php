<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Worker */

$this->title = 'Bajarilgan ishni qo`shish';
$this->params['breadcrumbs'][] = ['label' => 'Workers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="worker-create">

    

    <?= $this->render('_formworker', [
        'model' => $model,
        'xabar' => $xabar,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\Tovar */

$this->title = $tovar->name;
$this->params['breadcrumbs'][] = ['label' => 'Tovars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tovar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $tovar->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $tovar->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $tovar,
        'attributes' => [
            'id',
            'name',
            'price',
        ],
    ]) ?>

</div>
<h2 align="center">Tovarga  operatsiyalar biriktirish</h2>

<div class="row">
    <!-- Chap tomon (Available) -->
    <div class="col-md-5">
        <input type="text" id="search-available" class="form-control" placeholder="Qidirish..." style="margin-bottom:5px;">
        <select id="available" class="form-control" size="20" multiple>
            <?php foreach ($model->available as $id => $name): ?>
                <option value="<?= $id ?>"><?= Html::encode($name) ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <!-- Tugmalar -->
    <div class="col-md-2 text-center" style="margin-top: 100px;">
        <button type="button" id="btn-assign" class="btn btn-success">&gt;&gt;</button><br><br>
        <button type="button" id="btn-remove" class="btn btn-danger">&lt;&lt;</button>
    </div>

    <!-- O'ng tomon (Assigned) -->
    <div class="col-md-5">
        <input type="text" id="search-assigned" class="form-control" placeholder="Qidirish..." style="margin-bottom:5px;">
        <select id="assigned" class="form-control" size="20" multiple>
            <?php
            $assignedOps = \frontend\models\Code::find()->where(['id' => $model->assigned])->all();
            foreach ($assignedOps as $op): ?>
                <option value="<?= $op->id ?>"><?= Html::encode($op->code) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<?php
$assignUrl = Url::to(['tovar/assign-op', 'id' => $model->product_id]);
$removeUrl = Url::to(['tovar/remove-op', 'id' => $model->product_id]);

$js = <<<JS
// Qidiruv funksiyasi
function filterList(inputId, listId) {
    let query = \$('#' + inputId).val().toLowerCase();
    \$('#' + listId + ' option').each(function() {
        let text = \$(this).text().toLowerCase();
        \$(this).toggle(text.indexOf(query) !== -1);
    });
}

\$('#search-available').on('keyup', function() {
    filterList('search-available', 'available');
});

\$('#search-assigned').on('keyup', function() {
    filterList('search-assigned', 'assigned');
});

// Qo‘shish (>>)
\$('#btn-assign').click(function() {
    let selected = \$('#available option:selected');
    if (selected.length === 0) return;

    let ids = [];
    selected.each(function() {
        ids.push(\$(this).val());
    });

    \$.post('$assignUrl', {ids: ids}, function(response) {
        if (response.success) {
            selected.appendTo('#assigned');
        }
    });
});

// O‘chirish (<<)
\$('#btn-remove').click(function() {
    let selected = \$('#assigned option:selected');
    if (selected.length === 0) return;

    let ids = [];
    selected.each(function() {
        ids.push(\$(this).val());
    });

    \$.post('$removeUrl', {ids: ids}, function(response) {
        if (response.success) {
            selected.appendTo('#available');
        }
    });
});
JS;

$this->registerJs($js);
?>

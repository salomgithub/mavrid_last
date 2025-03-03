<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseOutputSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bichish';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-output-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <table class="table table-striped table-bordered"><thead>
        <tr><th>#</th>
            <th>Mahsulot nomi</th>
            <th>Soni</th>
            <th>Chiqim sanasi</th>
            <th>Operatsiya bajarilgan vaqt</th>
            <th>Status</th>
            <th>Status</th>

        </tr>
        </thead>
            <tbody>
<?php $i = 0 ?>
            <?php foreach ($model as $key): ?>
                <tr data-key="3">
                    <?php $i++ ?>
                    <td><?= $i ?></td>
                    <td><?= \frontend\models\Materials::findOne($key->material_id)->name ?></td>
                    <td><?= (int)$key->quantity ?></td>
                    <td><?= $key->date_of_exit ?></td>
                    <td><?= $key->created_at ?></td>
                    <td><?= $key->status ?></td>
                    <td><?=  Html::a('Tasdiqlash', ['bichish/status', 'id' => $key->id], [
                            'class' => 'btn btn-success',
                            'data' => [
                                'confirm' => 'Siz bu elementni tasdiqlamoqchimisiz?',
                                'method' => 'post',
                            ],
                        ]);?></td>
<?php endforeach; ?>
            </tbody>
    </table>



</div>

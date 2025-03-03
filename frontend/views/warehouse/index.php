<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WarehouseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Omborxona';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="warehouse-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(' + Bozordan qabul qilish', ['create_tovar'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(' + Ishchilardan qabul qilish', ['create_order'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Barcha mavriddan kelgan tovarlar', ['indexin'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('tashqaridan kelgan tovarlar', ['indexout'], ['class' => 'btn btn-primary']) ?>
    </p>
    <pre>
        <?php
        $report_in = \frontend\models\Warehouse::find()->asArray()->all();
        $report_out = \frontend\models\Warehouseout::find()->asArray()->all();
        var_dump($report_in);
        echo "<br>";
        echo "<br>";
        var_dump($report_out);
        foreach ($report_in as $item) {
            $report_out[] = $item;
        }
//        $report_out += $report_in;
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        usort($report_out, function($a, $b) {
            return strtotime($a['create_data']) - strtotime($b['create_data']);
        });
        var_dump($report_out);
echo "<table>";
echo "<tr><th>ID</th><th>Order ID</th><th>Tovar ID</th><th>Soni</th><th>Create Data</th></tr>";

// Massivdagi har bir element uchun qatorlarni chiqarish
foreach ($report_out as $item) {
    echo "<tr>";
    echo "<td>" . $item['id'] . "</td>";
    if (empty($item['order_id'])) $item['order_id'] = 'tashqaridan kirgan tovar';
    echo "<td>" . $item['order_id']. "</td>";
    echo "<td>" . $item['tovar_id'] . "</td>";
    echo "<td>" . $item['soni'] . "</td>";
    echo "<td>" . $item['create_data'] . "</td>";
    echo "</tr>";
}
        ?>


    </pre>
    <table id="example" class="kv-grid-table table table-bordered table-striped kv-table-wrap">
        <tr class="w5">
            <td align="center" ><b>Hodim ID</td>
            <td align="center" ><b>Umumiy hisoblangan summa</td>
            <td align="center" ><b>Umumiy hisoblangan operatsiyalar soni</td>
        </tr>

        <?php if (isset($query)): ?>
            <?php foreach ($query as $key ): ?>
                <tr class="w5">
                    <?php $tartib_raqam = 0; ?>
                    <?php foreach ($key as $i ): ?>
                        <td align="right" >
                            <?php $tartib_raqam++;

                            if ($tartib_raqam == 1) {
                                $employee = Employees::findOne($i);
                                $firstname = $employee->firstname;
                                $lastname = $employee->lastname;
                                $namefather = $employee->namefather;
                                $name = $firstname." ".$lastname." ".$namefather;
                                $i = $name;

                            }else
                                $i= number_format("$i");

                            echo $i;
                            ?>

                        </td>

                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>








    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    --><?//= GridView::widget([
//        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
//        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//
//            'id',
//            'order_id',
////            'tovar_id',
//            [
//                'attribute'=>'tovar_id',
//                'filter'=>\yii\helpers\ArrayHelper::map(\frontend\models\Tovar::find()->all(),'id','name'),
//                'value'=>'tovar.name',
//                'label'=>'Model'
//            ],
//            'soni',
//            'create_data',
//
//            ['class' => 'yii\grid\ActionColumn'],
//        ],
//    ]); ?>



</div>

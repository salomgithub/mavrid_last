<?php
$this->title = 'Omborxona Monitoringi';
// $this->params['breadcrumbs'][] = $this->title;
$script = <<< JS
            $(document).ready(function () {
            $(document).ready(function () {
                $('table').DataTable({                    
                    dom: 'Blfrtip',
                    buttons: [
                    {
                        text: 'Excel',                       
                        extend: 'excelHtml5',
                        exportOptions: {
                            modifier: {
                                selected: true
                            },
                            columns: [0, 1, 2, 3, 4],
                            format: {
                                header: function (data, columnIdx) {
                                    return data;
                                },
                                body: function (data, column, row) {
                                    // Strip $ from salary column to make it numeric
                                    debugger;
                                    return column === 4 ? "-" : data;
                                }
                            }
                        },
                        footer: false,
                        customize: function (xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            //$('c[r=A1] t', sheet).text( 'Custom text' );
                            //$('row c[r^="C"]', sheet).attr('s', '2');
                        }
                    },
                    {
                        text: 'Nusxa olish',
                        extend: 'copy',
                    }]
                });
            });
        });
        JS;
$this->registerJs($script);


use frontend\models\Orders;
use yii\helpers\Html;
?>
<pre>
<?= Html::a('ortga', ['warehouse'], ['class' => 'btn btn-primary back']) ?>
</pre>

<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Tovar ID</th>
        <th>Buyurtma soni</th>
        <th>Kirim soni</th>
        <th>Farqi soni</th>

    </tr>
    </thead>
    <tbody>

    <?php
    use frontend\models\Employees;
    if (isset($warehouse)): ?>
        <?php foreach ($warehouse as $item ): ?>
            <tr class="w5">
                <td><?=$item["order_id"]?></td>
                <td>
                    <?php
                        $tovar = \frontend\models\Tovar::findOne($item["tovar_id"]);
                        $tovar_name = $tovar->name;
                        echo $tovar_name;
                    ?>
                </td>
                <td>
                    <?php
                        $order = Orders::findOne($item['order_id']);
                        $order_soni = $order->soni;
                        $warehouse_soni = $item["soni"];
                        $farq = $order_soni - $warehouse_soni;
                        echo $order_soni;
                    ?>
                </td>
                <td><?=$item["soni"]?></td>
                <td><?=$farq?></td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
    </tbody>
</table>




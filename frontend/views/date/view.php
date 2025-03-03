        <?php
$this->title = 'Maosh';
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
                            columns: [0, 1, 2, 3],
                            format: {
                                header: function (data, columnIdx) {
                                    return data;
                                },
                                body: function (data, column, row) {
                                    // Strip $ from salary column to make it numeric
                                    debugger;
                                    return  data;
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
use yii\helpers\Html;
        ?>
<?= Html::a('ortga', ['create'], ['class' => 'btn btn-primary back']) ?>
<h1 align="center">
    [<?=$start?> - <?=$end?>]
</h1>

<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>№</th>
            <th>Hodim ID</th>
            <th>Umumiy hisoblangan summa</th>
            <th>Umumiy hisoblangan operatsiyalar soni</th>
            
        </tr>
    </thead>
    <tbody>

   <?php
        if (isset($query)):
            $nomer = 1;
   ?>
        <?php foreach ($query as $key ): ?>
            <tr class="w5">
                <td>
                    <?=$nomer?>
                </td>
                <td>
                    <?php
                        $employee = \frontend\models\Employees::findOne($key['employee_id']);
                        $firstname = $employee->firstname;
                        $lastname = $employee->lastname;
                        $namefather = $employee->namefather;
                        $name = $firstname." ".$lastname." ".$namefather;
                        echo $name;
                    ?>
                </td>
                <td>
                    <?= $key['Jami_Oylik'] ?>
                </td>
                <td>
                    <?= $key['Jami_Oper'] ?>
                </td>
                <?php $nomer++; ?>


            </tr>
        <?php endforeach ?>
    <?php endif ?>
    </tbody>
</table>
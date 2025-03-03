<?php
use yii\helpers\Html;
use frontend\models\Employees;
?>

<div class="worker-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('+', ['createworker'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="worker-index">
    <table class="table table-striped table-bordered">
        <th>Jarayon Id</th>
        <th>Tabel Id - ISM</th>
        <th>Buyurtma Id</th>
        <th>Operatsiya Id</th>
        <th>Soni</th>
        <th>Vaqti</th>
        <!-- <th>Summasi</th> -->
    <?php
        foreach ($model as $key) {
            $sanoq = 1;
            echo"<tr>";
            foreach ($key as $i) {
                // if($sanoq == 2) {
                //     $surov = Employees::findOne($i);
                //     $surov = $surov->firstname;
                //     $i = $i." - ".$surov;
                // }
                if ($sanoq!=7) {
                    # code...
                    echo"<td>".$i."</td>";
                    }
                $sanoq++;
                }
            echo"</tr>";

        }

    ?>
    </table>

</div>


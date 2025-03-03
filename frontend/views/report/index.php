<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Employees */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employees-form">
    <h1>Hisobotlar</h1>
    <p>
        <?= Html::a('Tashqaridan va ichkaridan kirimlar', ['kirimchiqim'], ['class' => 'btn btn-lg btn-success']) ?>
        <?= Html::a('Buyurtma kirim & Braklar', ['warehouse'], ['class' => 'btn btn-lg btn-primary']) ?>
        <?= Html::a('---------', ['indexout'], ['class' => 'btn btn-primary']) ?>

    </p>
    <?php


    $dataPoints1 = array(
        array("label"=> "2010", "y"=> 36.12),
        array("label"=> "2011", "y"=> 34.87),
        array("label"=> "2012", "y"=> 40.30),
        array("label"=> "2013", "y"=> 35.30),
        array("label"=> "2014", "y"=> 39.50),
        array("label"=> "2015", "y"=> 50.82),
        array("label"=> "2016", "y"=> 74.70)
    );
    $dataPoints2 = array(
        array("label"=> "2010", "y"=> 64.61),
        array("label"=> "2011", "y"=> 70.55),
        array("label"=> "2012", "y"=> 72.50),
        array("label"=> "2013", "y"=> 81.30),
        array("label"=> "2014", "y"=> 63.60),
        array("label"=> "2015", "y"=> 69.38),
        array("label"=> "2016", "y"=> 98.70)
    );
$data = date('Ymd');
$dataH = date('H')+2;
$datasekund = date('is');
$a = $data.$dataH.$datasekund;
echo $a;
    ?>
<!--    <pre>-->
<!--        --><?// var_dump($dataPoints1);?>
<!--        --><?// var_dump($dataPoints3);?>
<!--    </pre>-->
    <script>
        window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                theme: "light2",
                title:{
                    text: "Natijalar"
                },
                axisY:{
                    includeZero: true
                },
                legend:{
                    cursor: "pointer",
                    verticalAlign: "center",
                    horizontalAlign: "right",
                    itemclick: toggleDataSeries
                },
                data: [{
                    type: "column",
                    name: "Real",
                    indexLabel: "{y}",
                    yValueFormatString: "$#0.##",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                },{
                    type: "column",
                    name: "Artificial",
                    indexLabel: "{y}",
                    yValueFormatString: "$#0.##",
                    showInLegend: true,
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

            function toggleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                }
                else{
                    e.dataSeries.visible = true;
                }
                chart.render();
            }

        }
    </script>

    <div id="chartContainer" style="height: 370px; width: 100%;">a</div>
    <script src="frontend/web/js/chart.js"></script>

</div>

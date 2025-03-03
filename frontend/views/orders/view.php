<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Progress;
use frontend\models\Code;
use frontend\models\Worker;
use yii\db\Expression;

/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <?
    $tovar_id = $model->tovar_id;
    $tovar_model =  \frontend\models\Tovar::findOne($tovar_id);
    $tovar_name = $tovar_model->name;

    $color_model = \frontend\models\Color::findOne($model->color_id);
    $color_name = $color_model->color;

    $tovar_soni = $model->soni;

    $tovar_soni = $model->soni;

    $size_model = \frontend\models\Size::findOne($model->size_id);
    $size_name = $size_model->size;


    ?>
</pre>

<table width="100%">
    <tr>
        <td bgcolor="#00ffff">
            <p>
                <?= Html::a('O`zgartirish', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('O`chirish', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Haqiqatdan ham o`chirmoqchimisiz, ',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'tovar_id',
                    'color_id',
                    'size_id',
                    'soni',
                    'brak_soni',
                    'date',
                    'status',
                    [
                        'attribute'=>'status',
                        'label'=>'%',
                        'format'=>'raw',
                        'value'=>function($model){
                            $order_id = $model->id;
                            $tovar_id = $model->tovar_id;
                            $soni = $model->soni;
                            $codes_id_tovar_id = Code::find()->where(['tovar_id'=>$tovar_id])->count();
                            $umumiy = $soni * $codes_id_tovar_id;

                            $online = Worker::find()->select(['soni'])->where(['order_id'=>$order_id])->all();
                            $soni=0;
                            foreach ($online as $i ) {
                                $soni+=$i->soni;
                            }
                            $result  = $soni*100/$umumiy;

                            $result = number_format((float)$result, 0, '.', '');


                            $status = $model->status;
                            $status_btn = "default";
                            $is100 = 0;
                            if($result>=100){
                                $is100 = 1;
                                $result = 100;
                                $barOption = ['class' => 'progress-bar-success'];
                                $option = ['class' => 'active progress-striped'];
                            }
                            elseif($status<0){
                                $result = 0;
                                $barOption = ['class' => 'progress-bar-primary'];
                                $option = ['class' => 'active progress-striped'];
                            }
                            else{
                                $barOption = ['class' => 'progress-bar-primary'];
                                $option = ['class' => 'active progress-striped'];
                            }
                            if ($is100 === 1) {
                                $natija = Progress::widget([
                                    'percent' => $result,
                                    'label' => $result.'%',
                                    'barOptions' => $barOption,
                                    // 'options' => $option
                                ]);
                            } else {
                                $natija = Progress::widget([
                                    'percent' => $result,
                                    'label' => $result.'%',
                                    'barOptions' => $barOption,
                                    'options' => $option
                                ]);
                            }

                            return $natija;
                        }
                    ],
                ],
            ]) ?>
        </td>
        <td align="right" bgcolor="silver">
            <div class="bg-info">
                <div id="print-title"><button >  <h3>№<?=$model->id?></h3> </button> <b><?=$model->date?></b><br></div>
            <div id="print-img"><b>
                1) rangi: <?=$color_name?></b>
                2) Soni: <b><?=$tovar_soni?> </b><br>
                3) O`lchami: <b>-<?=$size_name?></b>
                4) Model nomi: <b><?=$tovar_name?></b>
            </div>
            <div id="print-text">
                <table border="true" width="100%">
                    <tr>
                        <td> Sana </td>
                        <td> Bajargan hodim </td>
                        <td> Kod </td>
                        <td> Soni </td>
                        <td> Izoh </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>.</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>_</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>_</td>
                    </tr>
                </table>
            </div>
            </div>
            <a href="#" class="btn btn-primary" onclick="javascript:callPrint();">Печать</a>
        </td>
    </tr>
</table>




    <script>
        function callPrint() {
            var printCSS = '<link rel="stylesheet" href="css/print.css" type="text/css" />';
            var printTitle = document.getElementById('print-title').innerHTML;
            var printImg = document.getElementById('print-img').innerHTML;
            var printText = document.getElementById('print-text').innerHTML;
            var windowPrint = window.open('','','left=50,top=10,width=1800,height=640,toolbar=0,scrollbars=1,status=0');
            windowPrint.document.write(printCSS);
            windowPrint.document.write(printTitle);
            windowPrint.document.write(printImg);
            windowPrint.document.write(printText);
            windowPrint.document.close();
            windowPrint.focus();
            windowPrint.print();
            windowPrint.close();
        }
    </script>



<h3>Batafsil operatsiya ma'lumotlar</h3>
<table class="table table-striped table-bordered">
    <tr>
        <th width="30%">Operatsiya nomi</th>
        <th width="10%">Soni (<?php echo $model->soni; ?>) </th>
        <th>%</th>
    </tr>
    <tr>
        <?php 

            $order_id = $model->id;
            $tovar_id = $model->tovar_id;
            $soni = $model->soni;
    
            $online = Worker::find()->select(['code_id', new Expression('SUM(soni) as Jami_Oper'),])->where(['order_id'=>$order_id])->groupBy('code_id')->asArray()->all();

            foreach ($online as $i) {
                $worker_soni = $i['Jami_Oper'];
                $order_soni = $model->soni;
                $result = $worker_soni*100/$order_soni;

                $result = number_format((float)$result, 0, '.', '');


                $status = $model->status;
                $status_btn = "default";
                $is100 = 0;
                if($result>=100){
                    $is100 = 1;
                    $result = 100;
                    $barOption = ['class' => 'progress-bar-success'];
                    $option = ['class' => 'active progress-striped'];
                }
                elseif($status<0){
                    $result = 0;
                    $barOption = ['class' => 'progress-bar-primary'];
                    $option = ['class' => 'active progress-striped'];   
                }
                else{
                    $barOption = ['class' => 'progress-bar-primary'];
                }
                if ($is100 == 1) {
                    $natija = Progress::widget([
                        'percent' => $result,
                        'label' => $result.'%',
                        'barOptions' => $barOption,
                        // 'options' => $option
                    ]);
                } else {
                    $natija = Progress::widget([
                        'percent' => $result,
                        'label' => $result.'%',
                        'barOptions' => $barOption,
                        'options' => $option
                    ]);
                }
                $code_name = Code::findOne($i['code_id']);
                echo "<td>".$code_name->code." - ".$i['Jami_Oper']."</td>";
                echo "<td>".$i['Jami_Oper']."</td>";
                echo "<td>$natija</td>";
                echo "</tr>";

            }
            $codes = Code::find()->select(['id','code','tovar_id'])->where(['tovar_id'=>$tovar_id])->all();
            foreach ($codes as $key ) {
                $surov = Worker::find()->where(['order_id'=>$order_id, 'code_id'=>$key->id])->all();
                if (!$surov) {
                    $result = 0;
                    $barOption = ['class' => 'progress-bar-primary'];
                    $option = ['class' => 'active progress-striped'];
                    echo "<tr>";
                    echo "<td>".$key->code."</td>";
                    echo "<td>0</td>";
                    echo "<td>".Progress::widget([
                        'percent' => $result,
                        'label' => $result.'%',
                        'barOptions' => $barOption,
                        'options' => $option
                    ])."</td>";
                    echo "</tr>";

                }
            }
        ?>
</table>

</div>
        
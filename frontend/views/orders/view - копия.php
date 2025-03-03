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
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
        
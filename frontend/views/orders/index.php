<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use frontend\models\Tovar;
use frontend\models\Color;
use frontend\models\Worker;
use frontend\models\Code;
use frontend\models\Size;
use yii\bootstrap\Progress;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buyurtmalar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php 

// echo Progress::widget([
//     'bars' => [
//         ['percent' => 30, 'options' => ['class' => 'progress-bar-danger']],
//         ['percent' => 30, 'label' => 'test', 'options' => ['class' => 'progress-bar-success']],
//         ['percent' => 35, 'options' => ['class' => 'progress-bar-warning']],
//     ]
// ]);

// echo Progress::widget([
//     'percent' => 60,
//     'label' => 'test',
// ]);

// // styled
// echo Progress::widget([
//     'percent' => 65,
//     'barOptions' => ['class' => 'progress-bar-danger']
// ]);

// striped
// echo Progress::widget([
//     'percent' => 99,
//     'barOptions' => ['class' => 'progress-bar-warning'],
//     'options' => ['class' => 'progress-striped']
// ]);
// $a = 50;
// // striped animated
// echo Progress::widget([
//     'percent' => $a,
//     'label' => $a.'%',
//     'barOptions' => ['class' => 'progress-bar-success'],
//     'options' => ['class' => 'active progress-striped']
// ]);

 ?>
    
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= Html::a('Create Orders', ['create'], ['class' => 'btn btn-success']) ?>
    

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel'=>'<<<',
            'lastPageLabel'=>'>>>',
            'nextPageLabel'=>'>',
            'prevPageLabel'=>'<',
            'maxButtonCount'=>10,

        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'tovar_id',
            [
                'attribute'=>'tovar_id',
                'filter'=>ArrayHelper::map(Tovar::find()->all(),'id','name'),
                'value'=>'tovar.name'
            ],
            [
                'attribute'=>'color_id',
                'filter'=>ArrayHelper::map(Color::find()->all(),'id','color'),
                'value'=>'color.color'
            ],
            [
                'attribute'=>'size_id',
                'filter'=>ArrayHelper::map(Size::find()->all(),'id','size'),
                'value'=>'size.size'
            ],
            'soni',
            // 'color_id',
            // 'size_id',
            //'brak_soni',
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
                    if ($umumiy === 0) {
                        $umumiy=0.1;
                    }

                    $result  = $soni*100/$umumiy;

                    $result = number_format((float)$result, 0, '.', '');

                    
                    $status = $model->status;
                    $status_btn = "default";
                    $is100 = 0;
                    if($result>=100){
                        $is100 = 1;
                        $result = 100;
                        $barOption = ['class' => 'progress-bar-primary'];
                        $option = ['class' => 'active progress-striped'];
                    }
                    elseif($status<0){
                        $result = 0;
                        $barOption = ['class' => 'progress-bar-success'];
                        $option = ['class' => 'active progress-striped'];   
                    }
                    else{
                        $barOption = ['class' => 'progress-bar-success'];
                        $option = ['class' => 'active progress-striped'];
                    }
                    
                    if ($is100===1) {
                        $natija = Progress::widget([
                                    'percent' => $result,
                                    'label' => $result.'%',
                                    'barOptions' => $barOption,
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

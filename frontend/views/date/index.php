<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\export\ExportMenu;
use frontend\models\Employees;
use frontend\models\Worker;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ma`lumotlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="date-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    
        <?= Html::a('Vaqt oralig`ini ko`rsatish', ['create'], ['class' => 'btn btn-success']) ?>
    

<?php 


    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'employee_id',
        [
            'attribute'=>'employee_id',
            // 'filter'=>ArrayHelper::map(Employees::find()->all(),'id','firstname'),
            'value'=>'employees.firstname'
        ],
        [
            'attribute'=>'saloma',
            // 'filter'=>ArrayHelper::map(Employees::find()->all(),'id','firstname'),
            'value'=>'employee_id'
        ],
        'Jami_Oylik',
        'Jami_Oper',
        // ['class' => 'yii\grid\ActionColumn'],
    ];

    // Renders a export dropdown menu
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]);

    // You can choose to render your own GridView separately
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => $gridColumns
    ]);


?>

 
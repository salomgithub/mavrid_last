<?php

namespace frontend\controllers;

use frontend\models\Employees;
use frontend\models\User;
use Yii;
use frontend\models\Worker;
use frontend\models\WorkSearch;
use frontend\models\Code;
use frontend\models\Orders;
use frontend\models\Tovar;
use frontend\models\Oylik;
use frontend\models\WorkerSearch;
use frontend\models\WorkerrSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * WorkerController implements the CRUD actions for Worker model.
 */
class WorkerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Worker models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'manager';
        $searchModel = new WorkerSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Worker model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'admin';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Worker model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'manager';
        $model = new Worker();
        $xabar = "";

        if ($model->load(Yii::$app->request->post()) ) {
            $code_id = $model->code_id;
            $order_id = $model->order_id;
            $order = Orders::findOne($order_id);
            $order_soni = $order->soni;
            $tovar_id = $order->tovar_id;
            $code = Code::findOne($code_id);
            $code_tovar_id = $code->tovar_id;
            if(($code_tovar_id === $tovar_id) && $code_tovar_id && $tovar_id)
            {

                $code_soni = $model->soni;
                $code_by_order = Worker::find()->where(['order_id' => $order_id, 'code_id' => $code_id])->asArray()->all();
                $code_sum = 0;
                foreach ($code_by_order as $key ) {
                    $code_sum += $key['soni'];
                }
                $code_sum += $code_soni;

                if ($order_soni >= $code_sum) {

                    $code_narxi = $code->price;
                    $narxi = $code_narxi * $code_soni;
                    $model->narxi = $narxi;
                    
                    if ($model->save() ) {
                        $employee_id = $model->employee_id;
                        $model = new Worker();
                        $model->order_id = $order_id;
                        $model->code_id = $code_id;
                        $model->employee_id = $employee_id;
                        $code = Code::find()->where(['tovar_id'=>$tovar_id])->all();
                        $employee = Employees::find()->all();
                        // $this->refresh();
                        $xabar = "<h2 align='center' style='color: blue'>Ma`lumotlar qabul qilindi</h2>";
                        return $this->render('create', [
                                    'model' => $model,
                                    'code' => $code,
                                    'employee' => $employee,
                                    'xabar' => $xabar,
                                ]);
                    } else $xabar = "<h2 align='center' style='color: red'>Xatolik yuz berdi</h2>";
                }
                else{
                    $surov = Worker::findOne(['code_id'=>$code_id, 'order_id'=>$order_id]);
                    $employee_id_old = $surov->employee_id;
                    $fio = Employees::findOne($employee_id_old);
                    $lastname = $fio->lastname;
                    $firstname = $fio->firstname;
                    
                    $xabar = "<h2 align='center' style='color: red'>Buyurtmani bu operatsiyasida kiritilgan miqdorda xatolik mavjud  <b> ". (isset($lastname)? "yoki ".$lastname:0)." ".$firstname ."</b> tomonida </h2>";
                } 
            }
        }
        $employee = Employees::find()->all();
        $code = Code::find()->all();

        return $this->render('create', [
            'model' => $model,
            'code' => $code,
            'employee' => $employee,
            'xabar' => $xabar,
        ]);
    }
    
    public function actionList($id)
    {
        $tovars = Orders::findOne($id);
        $tovar_id = $tovars->tovar_id;
        $countCode = Code::find()
                ->where(['tovar_id'=>$tovar_id])
                ->count();

        $codes = Code::find()
                ->where(['tovar_id'=>$tovar_id])
                ->all();

        if ($countCode>0) {
                echo "<option value=''>....</option>";
            foreach ($codes as $code) {
                echo "<option value='".$code->id."'>".$code->code."</option>";
            }
        } else {
            echo "<option>-</option>";
        }
        
    }
    public function actionListtovar($id)
    {
        $tovars = Orders::findOne($id);
        $tovar_id = $tovars->tovar_id;
        
        $tovar_name = Tovar::findOne($tovar_id);
        $tovar_name = $tovar_name->name;

        echo "<option value='0'>".$tovar_name."</option>";
        
    }

//    public function actionUpdate($id)
//    {
//        $this->layout = 'admin';
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
//    }

    public function actionDelete($id)
    {
        $this->layout = 'admin';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionIndexworker()
    {
        $this->layout = 'main';

        $searchModel = new WorkerrSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexworker', [ 
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

        return $this->render('indexworker', [
            'model' => $list,
        ]);
    }

    public function actionCreateworker()
    {
        $this->layout = 'main';
        $model = new Worker();
        $xabar = "";

        if ($model->load(Yii::$app->request->post()) ) {
            $code_id = $model->code_id;
            $order_id = $model->order_id;
            $order = Orders::findOne($order_id);
            $order_soni = $order->soni;
            $tovar_id = $order->tovar_id;
            $code = Code::findOne($code_id);
            $code_tovar_id = $code->tovar_id;
            $user_id = Yii::$app->user->id;
            $employee = User::findOne($user_id);
            if ($employee) {
                $model->employee_id = $employee->employee_id;
            }
            
            if(($code_tovar_id === $tovar_id) && $code_tovar_id && $tovar_id){
                $code_soni = $model->soni;
                $code_by_order = Worker::find()->where(['order_id' => $order_id, 'code_id' => $code_id])->asArray()->all();
                $code_sum = 0;
                $worker_name = '';
                $worker_bajargan_ish_soni = 0;
                foreach ($code_by_order as $key ) {
                    // print "$code_soni"."--"."$key[soni]"."<br>";
                    $code_sum += $key['soni'];
                }
                $code_sum += $code_soni;

                if ($order_soni >= $code_sum) {
                    $code_narxi = $code->price;
                    $narxi = $code_narxi * $code_soni;
                    $model->narxi = $narxi;
                    
                    if(!$employee->employee_id){
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                    if ($model->save()) {
                        // $this->refresh();
                        $model = new Worker();
                        $xabar = "<h2 align='center' style='color: blue'>Qabul qilindi</h2>";
                    }
                    else echo "Bazaga yozishda xatolik WorkerController(Create action model save not) line:105";
                }
                else{
                    $lastname = '';
                    $firstname = '';
                    // $surov = Worker::find()->asArray()->all();
                    // echo "<pre>";
                    // var_dump($code_by_order);
                    // echo "</pre>";

                        $malumot .= $order_id." - ".$code->code."<br> Jami: ".$order_soni."<br>";
                    if (isset($code_by_order)) {
                        foreach ($code_by_order as $key) {
                            
                        $employee_id_old = $key["employee_id"];
                        $fio = Employees::findOne($employee_id_old);
                        $lastname = $fio->lastname;
                        $firstname = $fio->firstname;
                        $order_soni -= $key["soni"];
                        $malumot .= $lastname." ".$firstname." - ".$key["soni"]."<br>";
                        }
                    // $malumot.=;
                    // die("<br><br>stop");
                    }

                    $xabar = "<h4 align='center' style='color: red'>".$malumot."siz ".$order_soni." ta kirita olasiz </h4>";
                    // $xabar = "<h2 align='center' style='color: red'> $order_id -umumiy soni: $order_soni <br> $code->code<br><b> ". ((isset($lastname)) ? $lastname : '0') ." ".((isset($firstname)) ? $firstname : '0' ) ."</b> tomonidan </h2>";
                } 
            }
            else die('noqonuniy harakat');
        }
        return $this->render('createworker', [
            'model' => $model,
            'xabar' => $xabar,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Worker::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

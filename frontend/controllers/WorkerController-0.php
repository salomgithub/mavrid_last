<?php

namespace frontend\controllers;

use frontend\models\Employees;
use frontend\models\User;
use Yii;
use frontend\models\Worker;
use frontend\models\Code;
use frontend\models\Orders;
use frontend\models\Oylik;
use frontend\models\WorkerSearch;
use yii\base\BaseObject;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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

        if ($model->load(Yii::$app->request->post()) ) {
            $code_id = $model->code_id;
            $order_id = $model->order_id;
            $order = Orders::findOne($order_id);
            $order_soni = $order->soni;
            $code_soni = $model->soni; 
            $code_by_order = Worker::find()->where(['order_id' => $order_id, 'code_id' => $code_id])->asArray()->all();
            $code_sum = 0;
            foreach ($code_by_order as $key ) {
                // print "$code_soni"."--"."$key[soni]"."<br>";
                $code_sum += $key['soni'];
            }
            $code_sum += $code_soni;

            if ($order_soni >= $code_sum) {
                
                $code = Code::findOne($code_id);
                $code_narxi = $code->price;
                $narxi = $code_narxi * $code_soni;
                $model->narxi = $narxi;

                $oylik = Oylik::findOne(['employee_id'=>$model->employee_id]);

                if ($oylik) {
                    $summa = $oylik->summa;
                    $summa += $narxi;
                    $oylik->summa = $summa;
                    // die("mavjud - ".$summa);
                    if ($model->save() && $oylik->save()) {
                        // $model = new Worker();
                        return $this->render('create', [
                            'model' => $model,
                        ]);
//                       return $this->redirect(['view', 'id' => $model->id]);
                    } else echo "Bazaga yozishda xatolik WorkerController(Create action model save not) line:105";
                } else {
                    $oylik = new Oylik();
                        $oylik->employee_id = $model->employee_id;
                        $oylik->code_summa = $model->soni;
                        $oylik->summa = $narxi;
                        
                        if ($model->save() && $oylik->save()) {
                            // $model = new Worker();
                            return $this->render('create', [
                                'model' => $model,
                            ]);
//                            return $this->redirect(['view', 'id' => $model->id]);
                        } else echo "Bazaga yozishda xatolik WorkerController(Create action model save not) line:105";
                }

            }else echo "<br><br><h2 align='center' style='color: red'>Buyurtmadagi ". $order_soni ." tovar sonida ". $code_soni ." operatsiyalar soni oshib ketdi!!! xatolik WorkerController line:91</h2>";
            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Worker model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this->layout = 'admin';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Worker model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->layout = 'admin';
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Worker model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Worker the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

       public function actionIndexworker()
    {
        $this->layout = 'main';
        $user_id = Yii::$app->user->id;

        $model = User::findOne($user_id);
        $employee_id = $model->employee_id;

        $list = Worker::findAll(['employee_id'=>$employee_id]);

        return $this->render('indexworker', [
            'model' => $list,
        ]);
    }

    public function actionCreateworker()
    {
        $this->layout = 'main';
        $model = new Worker();

        if ($model->load(Yii::$app->request->post()) ) {
            $code_id = $model->code_id;
            $order_id = $model->order_id;
            $order = Orders::findOne($order_id);
            $order_soni = $order->soni;
            $code_soni = $model->soni;
            $code_by_order = Worker::find()->where(['order_id' => $order_id, 'code_id' => $code_id])->asArray()->all();
            $code_sum = 0;
            foreach ($code_by_order as $key ) {
                // print "$code_soni"."--"."$key[soni]"."<br>";
                $code_sum += $key['soni'];
            }
            $code_sum += $code_soni;

            if ($order_soni >= $code_sum) {

                $code = Code::findOne($code_id);
                $code_narxi = $code->price;
                $narxi = $code_narxi * $code_soni;
                $model->narxi = $narxi;

                $user_id = Yii::$app->user->id;

                $employee = User::findOne($user_id);
                $model->employee_id = $employee->employee_id;
                if(!$employee->employee_id){
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }


                $oylik = Oylik::findOne(['employee_id'=>$employee->employee_id]);

                if ($oylik) {
                    $summa = $oylik->summa;
                    $summa += $narxi;
                    $oylik->summa = $summa;
                    // die("mavjud - ".$summa);
                    if ($model->save() && $oylik->save()) {

                        $this->refresh();
                        $model = new Worker();
                        return $this->render('create', [
                            'model' => $model,
                        ]);
//                       return $this->redirect(['view', 'id' => $model->id]);
                    } else echo "Bazaga yozishda xatolik WorkerController(Create action model save not) line:105";
                } else {
                    $oylik = new Oylik();
                    $oylik->employee_id = $employee->employee_id;
                    $oylik->code_summa = $model->soni;
                    $oylik->summa = $narxi;

                    if ($model->save() && $oylik->save()) {
                        $model = new Worker();
                        return $this->render('create', [
                            'model' => $model,
                        ]);
//                            return $this->redirect(['view', 'id' => $model->id]);
                    } else echo "Bazaga yozishda xatolik WorkerController(Create action model save not) line:105";
                }

            }else echo "<br><br><h2 align='center' style='color: red'>Buyurtmadagi ". $order_soni ." tovar sonida ". $code_soni ." operatsiyalar soni oshib ketdi!!! xatolik WorkerController line:91</h2>";
            // return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('createworker', [
            'model' => $model,
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

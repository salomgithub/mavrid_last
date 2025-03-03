<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Date;
use frontend\models\Worker;
use frontend\models\Employees;
use frontend\models\WorkerSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Expression;

/**
 * DateController implements the CRUD actions for Date model.
 */
class DateController extends Controller
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

    // public function actions(){
    //     return ArrayHelper::merge(parent::actions(),[
           
    //     ])
    // }

    /**
     * Lists all Date models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Worker::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Date model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Date model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Date();
 
        if ($model->load(Yii::$app->request->post()) ) {
            $start = $model->from_date." 00:00:11";
            $end = $model->to_date." 23:59:59";
            
            $employee = Employees::find()->where(['status'=>1])->asArray()->all();

                // $worker = Worker::find()
                // ->select(['employee_id', new Expression('SUM(narxi) as Jami_Oylik'), new Expression('SUM(soni) as Jami_Oper'), ])
                // ->where(['between', 'date', $start, $end])
                // // ->andWhere(['status'=> 1])
                // // ->andWhere(['like', 'status', 1])
                // ->groupBy('employee_id')
                // ->asArray()
                // ->all();

            // $query =  \yii\db\query;
            // $query->select(['employee_id', new Expression('SUM(narxi) as Jami_Oylik'), new Expression('SUM(soni) as Jami_Oper'), ])
            //         ->from('worker')
            //         ->where(['between', 'date', $start, $end])
            //         ->groupBy('employee_id')
            //         ->all();

                    //     // ->andWhere(['status'=> 1])
                    //     // ->andWhere(['like', 'status', 1])
                
                $query = Worker::find()
                        ->select(['employee_id', new Expression('SUM(narxi) as Jami_Oylik'), new Expression('SUM(soni) as Jami_Oper'), ])
                        ->where(['between', 'date', $start, $end])
                        // ->andWhere(['status'=> 1])
                        // ->andWhere(['like', 'status', 1])
                        ->groupBy('employee_id')
                        ->asArray();
                        // ->all()


                $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    // 'query' => Worker::find()
                    //     ->select(['employee_id', new Expression('SUM(narxi) as Jami_Oylik'), new Expression('SUM(soni) as Jami_Oper'), ])
                    //     ->where(['between', 'date', $start, $end])
                    //     // ->andWhere(['status'=> 1])
                    //     // ->andWhere(['like', 'status', 1])
                    //     ->groupBy('employee_id')
                    //     ->asArray()
                    //     ->all(),
                    // 'pagination' => [
                    //     'pageSize' => 20,
                    // ],
                ]);

// var_dump($dataProvider);
// die();
            return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Date model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Date model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Date model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Date the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Date::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

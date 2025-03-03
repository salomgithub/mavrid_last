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
    public $layout = 'oylik';

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
        $this->layout = 'main';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $this->layout = 'admin';
        $model = new Date();
 
        if ($model->load(Yii::$app->request->post()) ) {
            $start = $model->from_date." 00:00:01";
            $end = $model->to_date." 23:59:59";
            
            $employee = Employees::find()->where(['status'=>1])->asArray()->all();
                
                $query = Worker::find()
                        ->select(['employee_id', new Expression('SUM(narxi) as Jami_Oylik'), new Expression('SUM(soni) as Jami_Oper'), ])
                        // ->leftJoin('employees', 'employees.id = worker.employee_id')
                        ->where(['between', 'date', $start, $end])
                        // ->andWhere(['status'=> 1])
                        // ->andWhere(['like', 'status', 1])
                        ->groupBy('employee_id')
                        ->asArray()
                        ->all();
            $this->layout = 'oylik';
            return $this->render('view', [
            'query' => $query,
            'start' => $start,
            'end' => $end,
        ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

}

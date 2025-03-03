<?php
namespace frontend\controllers;

use frontend\models\Orders;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use frontend\models\Warehouse;
use frontend\models\Worker;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\Date;
use frontend\models\Employees;
use frontend\models\WorkerSearch;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\db\Expression;

/**
 * Site controller
 */

class ReportController extends Controller
{
    public $layout = 'warehouse';
    public function actionIndex()
    {
        $model = new Date();
            // echo $start."0000".$end;

        if (Yii::$app->request->post() ) {
            $start = $model->from_date." 13:00:11";
            $end = $model->to_date." 13:05:40";
            print_r($model);

            $model = Worker::find()
                ->where(['between', 'date', $start, $end])
                // ->andWhere(['like', 'book', $bookName])
                ->asArray()
                ->all();

                    return $this->render('show', [
                'model' => $model,
            ]);
        }else{

            $model = new Date();
            return $this->render('index', [
                    'model' => $model,
                ]);

        }
    }
    public function actionWarehouse()
    {
        $model = new Date();

        if ($model->load(Yii::$app->request->post()) ) {
            $start = $model->from_date." 00:00:00";
            $end = $model->to_date." 23:59:59";

            $warehouse = Warehouse::find()
                ->where(['between', 'create_data', $start, $end])
                ->asArray()
                ->all();

//            foreach ($warehouse as $item) {
//                $order = Orders::findOne($item['order_id']);
//                $order_soni = $order->soni;
//            }
//            die();
             $this->layout = 'warehouse';
            return $this->render('show', [
                'warehouse' => $warehouse,
            ]);
        }

        return $this->render('warehouse', [
            'model' => $model,
        ]);
    }
    public function actionKirimchiqim()
    {
        $model = new Date();

        if ($model->load(Yii::$app->request->post()) ) {
            $start = $model->from_date." 00:00:00";
            $end = $model->to_date." 23:59:59";

            $warehouse = Warehouse::find()
                ->select(['tovar_id', new Expression('SUM(soni) as Jami_kirimlar') ])
                ->where(['between', 'create_data', $start, $end])
                ->groupBy('tovar_id')
                ->asArray()
                ->all();


             $this->layout = 'warehouse';
            return $this->render('kirimchiqim', [
                'warehouse' => $warehouse,
                'start' => $start,
                'end' => $end,
            ]);
        }

        return $this->render('datakirimchiqim', [
            'model' => $model,
        ]);
    }

}
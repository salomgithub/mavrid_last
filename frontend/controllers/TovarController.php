<?php

namespace frontend\controllers;

use frontend\models\Code;
use frontend\models\ProductOperationForm;
use frontend\models\TovarCode;
use Yii;
use frontend\models\Tovar;
use frontend\models\TovarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TovarController implements the CRUD actions for Tovar model.
 */
class TovarController extends Controller
{
    public $layout = 'admin';

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
        $searchModel = new TovarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = new ProductOperationForm();
        $model->product_id = $id;

        $assignedIds = TovarCode::find()
            ->select('code_id')
            ->where(['tovar_id' => $id])
            ->column();

        $model->assigned = $assignedIds;

        $allOps = \yii\helpers\ArrayHelper::map(Code::find()->all(), 'id', 'code');

        $model->available = array_diff_key($allOps, array_flip($assignedIds));

        return $this->render('view', [
            'tovar' => $this->findModel($id),
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Tovar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

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

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Tovar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAssignOperations($id)
    {
        $model = new ProductOperationForm();
        $model->product_id = $id;

        $assignedIds = TovarCode::find()
            ->select('code_id')
            ->where(['tovar_id' => $id])
            ->column();

        $model->assigned = $assignedIds;

        $allOps = \yii\helpers\ArrayHelper::map(Code::find()->all(), 'id', 'code');

        $model->available = array_diff_key($allOps, array_flip($assignedIds));

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post('ProductOperationForm');
            $selectedOps = $post['assigned'] ?? [];

            // remove all old
            TovarCode::deleteAll(['tovar_id' => $id]);

            // add new
            foreach ($selectedOps as $opId) {
                $po = new TovarCode();
                $po->tovar_id = $id;
                $po->code_id = $opId;
                $po->save();
            }

            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('assign-operations', [
            'model' => $model,
        ]);
    }

    public function actionAssignOp($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $ids = Yii::$app->request->post('ids', []);

        foreach ($ids as $opId) {
            $exists = TovarCode::find()
                ->where(['tovar_id' => $id, 'code_id' => $opId])
                ->exists();

            if (!$exists) {
                $po = new TovarCode();
                $po->tovar_id = (int )$id;

                $po->code_id = (int)$opId;
                if (!$po->save()) {
                    Yii::error($po->errors, 'assign-op');
                    return ['success' => false, 'error' => $po->errors];
                }

            }

        }
        return ['success' => true];
    }

    public function actionRemoveOp($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $ids = Yii::$app->request->post('ids', []);

        TovarCode::deleteAll([
            'tovar_id' => $id,
            'code_id' => $ids
        ]);

        return ['success' => true];
    }


}

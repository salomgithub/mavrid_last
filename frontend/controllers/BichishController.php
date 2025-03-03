<?php

namespace frontend\controllers;

use frontend\models\Materials;
use frontend\models\Warehouse;
use frontend\models\WarehouseInput;
use frontend\models\WarehouseInputSearch;
use frontend\models\WarehouseOutput;
use frontend\models\WarehouseOutputSearch;
use Yii;
use frontend\models\Bichish;
use frontend\models\BichishSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class BichishController extends Controller
{

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
       $model = WarehouseOutput::find()->where(['destination'=>1,'status'=>0])->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionQabul()
    {
        $searchModel = new WarehouseOutputSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('qabul', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionStatus($id)
    {
        $model = WarehouseOutput::findOne($id);
        $model->status = 10;
        $soni = $model->quantity;
        // Tranzaksiyani boshlash
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($model->save()) {
                $warehouse = Warehouse::find()->where(['material_id' => $model->material_id])->one();
                if ($warehouse) {
                    // Agar material_id mavjud bo'lsa, mavjud yozuvni yangilash
                    $warehouse->total_stock -= $soni; //qoldiq
                    $warehouse->total_out += $soni;

                    // Yangilanishni saqlash
                    if (!$warehouse->save()) {
                        throw new \Exception('Warehouse ma\'lumotlari saqlanmadı.');
                    }
                    // Tranzaksiyani tasdiqlash
                    $transaction->commit();Yii::$app->session->setFlash('error', "sss");
                    return $this->redirect(['index']);
                }
            }
        } catch (\Exception $e) {
            // Agar biron-bir xato yuz bersa, tranzaksiyani bekor qilish
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', $e->getMessage());
        }


        if ($model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
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
        if (($model = Bichish::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelout($id)
    {
        if (($model = WarehouseOutput::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

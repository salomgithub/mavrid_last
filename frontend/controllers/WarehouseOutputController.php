<?php

namespace frontend\controllers;

use frontend\models\Materials;
use frontend\models\Warehouse;
use Yii;
use frontend\models\WarehouseOutput;
use frontend\models\WarehouseOutputSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WarehouseOutputController implements the CRUD actions for WarehouseOutput model.
 */
class WarehouseOutputController extends Controller
{
    public $layout = 'warehouse';

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
        $searchModel = new WarehouseOutputSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $materials = ArrayHelper::map(Materials::find()->all(), 'id', 'name');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'materials' => $materials,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

//    public function actionCreate()
//    {
//        $model = new WarehouseOutput();
//        $materialsItems = (new \yii\db\Query())
//            ->select([
//                'w.material_id AS id',
//                'rm.name AS name',
//            ])
//            ->from('materials rm')
//            ->where(['>', 'w.total_stock', 0])
//            ->innerJoin('warehouse w', 'rm.id = w.material_id')
//            ->groupBy(['w.material_id']) // Group by material_id to avoid duplicates
//            ->all();
//        $materialsList = ArrayHelper::map($materialsItems, 'id', 'name');
//        $matretialsParams = [
//            'prompt' => 'Укажите Tovar',
//        ];
//
//        // Tranzaksiyani boshlash
//        $transaction = Yii::$app->db->beginTransaction();
//
//        try {
//            if ($model->load(Yii::$app->request->post()) && $model->save()) {
//                $warehouse = Warehouse::find()->where(['material_id' => $model->material_id])->one();
//                if ($warehouse) {
//                    // Agar material_id mavjud bo'lsa, mavjud yozuvni yangilash
//                    if ($warehouse->total_stock >= $model->quantity) {
//                        $warehouse->total_stock -= $model->quantity; // miqdor olingan
//                        $warehouse->total_out += $model->quantity;   // chiqimni yangilash
//
//                        // Yangilanishni saqlash
//                        if (!$warehouse->save()) {
//                            throw new \Exception('Warehouse ma\'lumotlari saqlanmadı.');
//                        }
//                    } else {
//                        throw new \Exception('Warehouse da etarli miqdor mavjud emas.');
//                    }
//                }
//
//                // Tranzaksiyani tasdiqlash
//                $transaction->commit();
//                return $this->redirect(['view', 'id' => $model->id]);
//            }
//        } catch (\Exception $e) {
//            // Agar biron-bir xato yuz bersa, tranzaksiyani bekor qilish
//            $transaction->rollBack();
//            Yii::$app->session->setFlash('error', $e->getMessage());
//        }
//
//        $materials = ArrayHelper::map(Materials::find()->all(), 'id', 'name');
//
//        return $this->render('create', [
//            'model' => $model,
//            'materialsList' => $materialsList,
//            'matretialsParams' => $matretialsParams,
//        ]);
//    }
    public function actionCreate()
    {
        $model = new WarehouseOutput();

        // Tranzaksiyani boshlash
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($model->load(Yii::$app->request->post())) {
                $warehouse = Warehouse::findOne(['material_id' => $model->material_id]);

                if ($warehouse->total_stock >= $model->quantity && $model->save()) {
                    $warehouse->total_stock -= $model->quantity;
                    $warehouse->total_out += $model->quantity;
                    // Tranzaksiyani tasdiqlash
                    if ($warehouse->save()) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } else {
                    var_dump($model->errors);
                    die();
                }
            }
        } catch (\Exception $e) {
            die();
            // Agar biron-bir xato yuz bersa, tranzaksiyani bekor qilish
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        $materialsItems = (new \yii\db\Query())
            ->select([
                'w.material_id AS id',
                'rm.name AS name',
            ])
            ->from('materials rm')
            ->where(['>', 'w.total_stock', 0])
            ->innerJoin('warehouse w', 'rm.id = w.material_id')
            ->groupBy(['w.material_id']) // Group by material_id to avoid duplicates
            ->all();
        $materialsList = ArrayHelper::map($materialsItems, 'id', 'name');
        $matretialsParams = [
            'prompt' => 'Укажите Tovar',
        ];
        $materials = ArrayHelper::map(Materials::find()->all(), 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'materialsList' => $materialsList,
            'matretialsParams' => $matretialsParams,
        ]);
    }

    public function actionStatus($id)
    {
        $model = $this->findModel($id);
        $model->status = 10;
        // Tranzaksiyani boshlash
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($model->save()) {
                $warehouse = Warehouse::find()->where(['material_id' => $model->material_id])->one();
                if ($warehouse) {
                    // Agar material_id mavjud bo'lsa, mavjud yozuvni yangilash
                    $warehouse->total_stock -= $model->quantity; //qoldiq
                    $warehouse->total_out += $model->quantity;

                    // Yangilanishni saqlash
                    if (!$warehouse->save()) {
                        throw new \Exception('Warehouse ma\'lumotlari saqlanmadı.');
                    }
                } else {
                    // Agar material_id mavjud bo'lmasa, yangi yozuv qo'shish
                    $warehouse = new Warehouse();
                    $warehouse->material_id = $model->material_id;
                    $warehouse->color = Materials::findOne($model->material_id)->color;
                    $warehouse->total_stock = $model->quantity;
                    $warehouse->total_in = $model->quantity;

                    if (!$warehouse->save()) {
                        Yii::$app->session->setFlash('error', 'Warehouse ma\'lumotlari saqlanmadı.');
                    }

                }

                // Tranzaksiyani tasdiqlash
                $transaction->commit();
                return $this->redirect(['index']);
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

    /**
     * Deletes an existing WarehouseOutput model.
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
     * Finds the WarehouseOutput model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WarehouseOutput the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WarehouseOutput::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

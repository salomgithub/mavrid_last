<?php

namespace frontend\controllers;

use frontend\models\Materials;
use frontend\models\Warehouse;
use Yii;
use frontend\models\WarehouseInput;
use frontend\models\WarehouseInputSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WarehouseInputController implements the CRUD actions for WarehouseInput model.
 */
class WarehouseInputController extends Controller
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
        $searchModel = new WarehouseInputSearch();
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

    public function actionCreate()
    {
        $model = new WarehouseInput();
        $materials = ArrayHelper::map(Materials::find()->all(), 'id', 'name');
        
        if ($model->load(Yii::$app->request->post()) ) {
            $model->summa = $model->price * $model->quantity;

            if ($model->save()) {

                $warehouse = Warehouse::find()->where(['material_id' => $model->material_id])->one();

                if ($warehouse) {
                    // Agar material_id mavjud bo'lsa, mavjud yozuvni yangilash
                    $warehouse->total_stock += $model->quantity;
                    $warehouse->total_in += $model->quantity;

                    // Yangilanishni saqlash
                    if (!$warehouse->save()) {
                        Yii::$app->session->setFlash('error', 'Warehouse ma\'lumotlari yangilanishida xatolik yuz berdi.');
                    }else {return $this->redirect(['index']);}
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

                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'materials' => $materials,
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
                    $warehouse->total_stock += $model->quantity; //qoldiq
                    $warehouse->total_in += $model->quantity;

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

    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    function findModel($id)
    {
        if (($model = WarehouseInput::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}

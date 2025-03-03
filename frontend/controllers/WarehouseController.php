<?php

namespace frontend\controllers;

use frontend\models\Materials;
use frontend\models\Orders;
use frontend\models\Qoldiq;
use frontend\models\Tovar;
use frontend\models\WarehouseInput;
use frontend\models\Warehouseout;
use frontend\models\WarehouseOutput;
use frontend\models\WarehouseoutSearch;
use Yii;
use frontend\models\Warehouse;
use frontend\models\WarehouseSearch;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * WarehouseController implements the CRUD actions for Warehouse model.
 */
class WarehouseController extends Controller
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

    public $layout = 'warehouse';

    public function actionIndex()
    {
        // Yii2 Active Record query
        $data_monitoring = (new \yii\db\Query())
            ->select([
                'rm.name AS material_name',
                'rm.color AS color',
                'total_in',
                'total_out',
                'total_stock',
                'w.updated_at',
            ])
            ->from('warehouse w')
            ->innerJoin('materials rm', 'w.material_id = rm.id')
            ->orderBy(['created_at' => SORT_ASC])
            ->all();

        $data_in = WarehouseInput::find()->orderBy(['created_at' => SORT_DESC])->limit(20)->all();
        $data_out = WarehouseOutput::find()->orderBy(['created_at' => SORT_DESC])->limit(20)->all();
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

        $tovars = Materials::find()->all();
        $tovars = ArrayHelper::map($tovars, 'id', 'name');

        $model_input = new WarehouseInput();
        $model_output = new WarehouseOutput();
        $model_add_tovar = new Materials();

        return $this->render('index', [
            'data_monitoring' => $data_monitoring,
            'data_in' => $data_in,
            'data_out' => $data_out,
            'materialsList' => $materialsList,
            'tovars' => $tovars,
            'model' => $model,
            'model_input' => $model_input,
            'model_output' => $model_output,
            'model_add_tovar' => $model_add_tovar,
        ]);
    }

    public function actionAddNewTovar()
    {
        $model = new Materials();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->actionIndex();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionKirim()
    {
        $model = new WarehouseInput();
        $materials = ArrayHelper::map(Materials::find()->all(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

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

                return $this->actionIndex();
            }
        }
        return $this->actionIndex();
    }

    public function actionChiqim()
    {
        $model = new WarehouseOutput();

        // Tranzaksiyani boshlash
        $transaction = Yii::$app->db->beginTransaction();

        try {
            if ($model->load(Yii::$app->request->post())) {
                $warehouse = Warehouse::findOne(['material_id' => $model->material_id]);

                if ($warehouse->total_stock >= $model->quantity && $model->save()) {

                        $transaction->commit();
                        return $this->redirect(['index']);

                } else {
                    var_dump($model->errors);
                    die("Ma\'lumotlar saqlanmadi yoki omborda yetarlicha tovar mavjud emas!");
                }
            }
        } catch (\Exception $e) {

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

    function findModel($id)
    {
        if (($model = Warehouse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}

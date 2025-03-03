<?php

namespace frontend\controllers;

use frontend\models\Orders;
use frontend\models\Qoldiq;
use frontend\models\Tovar;
use frontend\models\Warehouseout;
use frontend\models\WarehouseoutSearch;
use Yii;
use frontend\models\Warehouse;
use frontend\models\WarehouseSearch;
use yii\db\Query;
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

    public function actionIndex()
    {
        $searchModel = new WarehouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexout()
    {
        $searchModel = new WarehouseoutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexout', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionIndexin()
    {
        $searchModel = new WarehouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexin', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionViewout($id)
    {
        return $this->render('viewout', [
            'model' => $this->findModelout($id),
        ]);
    }
    public function actionCreate()
    {
        $model = new Warehouse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreate_tovar()
    {
        $model = new Warehouseout();

        if ($model->load(Yii::$app->request->post()) ) {
            $qoldiq = Qoldiq::findOne(['tovar_id'=>$model->tovar_id]);
            $qoldiq_id = $qoldiq->id;
            if (empty($qoldiq_id) ){
                $query = new Qoldiq();
                $query->tovar_id = $model->tovar_id;
                $query->soni = $model->soni;

                if ($query->save() && $model->save()){
                    return $this->redirect(['viewout', 'id' => $model->id]);
                }

            }else {
                $qoldiq = Qoldiq::findOne($qoldiq_id);
                $qoldiq->soni = $qoldiq->soni + $model->soni;
                if ($qoldiq->save() && $model->save()){
                    return $this->redirect(['viewout', 'id' => $model->id]);
                }

                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            return $this->redirect(['viewout', 'id' => $model->id]);
        }
        return $this->render('create_tovar', [
            'model' => $model,
        ]);
    }
//    public function actionCreate_tovar()
//    {
//        $model = new Warehouseout();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['viewout', 'id' => $model->id]);
//        }
//        return $this->render('create_tovar', [
//            'model' => $model,
//        ]);
//    }
    public function actionCreate_order()
    {
        $model = new Warehouse();
        if ($model->load(Yii::$app->request->post()) ) {
            $qoldiq = Qoldiq::findOne(['tovar_id'=>$model->tovar_id]);
            $qoldiq_id = $qoldiq->id;
            $order_soni = Orders::findOne($model->order_id);
            $order_soni = $order_soni->soni;

            $online_soni = Warehouse::find()->where(['order_id'=>$model->order_id])->sum('soni');
            $kirim_soni  = $model->soni;
            // var_dump("avval kiritilganlar soni =".$online_soni." ---"." hozir kirilitgani = ".$kirim_soni." order".$order_soni);

//            die();

            if ($kirim_soni <= ($order_soni- $online_soni)) {


                if (empty($qoldiq_id)) {
                    $query = new Qoldiq();
                    $query->tovar_id = $model->tovar_id;
                    $query->soni = $model->soni;
                    $query->save();
                    if ($query->save() && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } else {
                    $qoldiq = Qoldiq::findOne($qoldiq_id);
                    $qoldiq->soni = $qoldiq->soni + $model->soni;
                    if ($qoldiq->save() && $model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            }
            else $xato = "Miqdor buyurtmadan ortgan ";

//            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create_order', [
            'model' => $model,
            'xato' => $xato,
        ]);
    }

    public function actionListtovar($id)
    {
        $tovars = Orders::findOne($id);
        $tovar_id = $tovars->tovar_id;

        $tovar_name = Tovar::findOne($tovar_id);
        $tovar_name = $tovar_name->name;


        echo "<option  value='".$tovar_id."'>".$tovar_name."</option>";

    }

    /**
     * Updates an existing Warehouse model.
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
     * Deletes an existing Warehouse model.
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
     * Finds the Warehouse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Warehouse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Warehouse::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModelout($id)
    {
        if (($model = Warehouseout::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

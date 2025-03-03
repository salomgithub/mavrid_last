<?php

namespace frontend\controllers;

use frontend\models\Chiqim;
use frontend\models\Orders;
use frontend\models\Qoldiq;
use frontend\models\Tovar;
use frontend\models\Warehouseout;
use frontend\models\WarehouseoutSearch;
use frontend\models\ChiqimSearch;
use Yii;
use frontend\models\Warehouse;
use frontend\models\WarehouseSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ChiqimController extends Controller
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
     * Lists all Warehouse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChiqimSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionChiqim()
    {
        $model = new Chiqim();
        $tovar = Qoldiq::find()
            ->select(['qoldiq.tovar_id', 'tovar.name'])
            ->joinWith('tovar')
            ->asArray()
            ->all();


        $tovarItems = ArrayHelper::map($tovar,'tovar_id','name');

        $tovarParams = [
            'prompt' => '.........'
        ];
        if ($model->load(Yii::$app->request->post())  ) {
            $tovar_id = $model->tovar_id;
            $mavjud_tovar_in = Warehouse::find()->where(['tovar_id' => $tovar_id])->sum('soni');
            $mavjud_tovar_out = Warehouseout::find()->where(['tovar_id' => $tovar_id])->sum('soni');
            $mavjud_tovar_chiqim = Chiqim::find()->where(['tovar_id' => $tovar_id])->sum('soni');

            $soni = $model->soni;
            $umumiy_qoldiq = $mavjud_tovar_in + $mavjud_tovar_out - $mavjud_tovar_chiqim;

            if ($soni <= $umumiy_qoldiq){
                $qoldiq = Qoldiq::find()->where(['tovar_id'=>$tovar_id])->one();
                $qoldiq->soni = $qoldiq->soni - $soni;

                if ($model->save()&&$qoldiq->save()){

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }
            else {
                $xabar = "<h1>Omborda bunaqa qiymatdagi tovarlar mavjud emas</h1>";
                return $this->render('chiqim', [
                    'model' => $model,
                    'xabar' => $xabar,
                ]);
            }



        }
        return $this->render('chiqim', [
            'model' => $model,
            'tovarItems' => $tovarItems,
            'tovarParams' => $tovarParams,
        ]);
    }



    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Chiqim::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
     * Finds the Warehouse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Warehouse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
}

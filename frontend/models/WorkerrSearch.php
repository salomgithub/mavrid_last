<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Worker;
use yii\db\Expression;

use frontend\models\User;
use Yii;
use yii\base\BaseObject;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * WorkerSearch represents the model behind the search form of `frontend\models\Worker`.
 */
class WorkerrSearch extends Worker
{
    public $begin_date;
    public $end_date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'order_id', 'code_id', 'soni'], 'integer'],
            [['date','begin_date','end_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $user_id = Yii::$app->user->id;
        $model = User::findOne($user_id);
        $employee_id = $model->employee_id;

        $query = Worker::find()->where(["employee_id"=>$employee_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
            // var_dump($this->date);
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'order_id' => $this->order_id,
            'code_id' => $this->code_id,
            'soni' => $this->soni,
        ]);

        if((empty($this->begin_date)||empty($this->end_date))&&!empty($this->date)){
            $this->begin_date = $this->begin_date??$this->date;
            $this->end_date = $this->end_date??date('d.m.Y',strtotime('+1 day', strtotime($this->date)));
        }

         // strtotime('+1 day', strtotime($this->date))
        if(!empty($this->begin_date) && !empty($this->end_date)){
             $query->andFilterWhere([
                'between','date',date('Y-m-d',strtotime($this->begin_date)),date('Y-m-d',strtotime($this->end_date??time()))
            ]);
        }
       
        return $dataProvider;
    }
}

<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Orders;

/**
 * OrdersSearch represents the model behind the search form of `frontend\models\Orders`.
 */
class OrdersSearch extends Orders
{
    public $begin_date;
    public $end_date;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tovar_id', 'color_id', 'size_id', 'soni', 'brak_soni', 'status'], 'integer'],
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
        $query = Orders::find()->orderby(['id' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],

        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tovar_id' => $this->tovar_id,
            'color_id' => $this->color_id,
            'size_id' => $this->size_id,
            'soni' => $this->soni,
            'brak_soni' => $this->brak_soni,
            'date' => $this->date,
            'status' => $this->status,
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

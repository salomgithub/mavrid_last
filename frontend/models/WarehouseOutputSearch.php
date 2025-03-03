<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\WarehouseOutput;

/**
 * WarehouseOutputSearch represents the model behind the search form of `frontend\models\WarehouseOutput`.
 */
class WarehouseOutputSearch extends WarehouseOutput
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'material_id'], 'integer'],
            [['quantity'], 'number'],
            [['date_of_exit', 'destination', 'comments', 'created_at', 'updated_at'], 'safe'],
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
        $query = WarehouseOutput::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'material_id' => $this->material_id,
            'quantity' => $this->quantity,
            'date_of_exit' => $this->date_of_exit,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'destination', $this->destination])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}

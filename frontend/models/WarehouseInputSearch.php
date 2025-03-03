<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\WarehouseInput;

/**
 * WarehouseInputSearch represents the model behind the search form of `frontend\models\WarehouseInput`.
 */
class WarehouseInputSearch extends WarehouseInput
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'material_id'], 'integer'],
            [['quantity'], 'number'],
            [['date_received', 'storage_location', 'comments', 'created_at', 'updated_at'], 'safe'],
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
        $query = WarehouseInput::find();

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
            'date_received' => $this->date_received,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'storage_location', $this->storage_location])
            ->andFilterWhere(['like', 'comments', $this->comments]);

        return $dataProvider;
    }
}

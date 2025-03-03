<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Qoldiq;

/**
 * QoldiqSearch represents the model behind the search form of `frontend\models\Qoldiq`.
 */
class QoldiqSearch extends Qoldiq
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tovar_id', 'soni'], 'integer'],
            [['update_data'], 'safe'],
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
        $query = Qoldiq::find();

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
            'tovar_id' => $this->tovar_id,
            'soni' => $this->soni,
            'update_data' => $this->update_data,
        ]);

        return $dataProvider;
    }
}

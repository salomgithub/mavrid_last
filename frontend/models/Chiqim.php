<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "chiqim".
 *
 * @property int $id
 * @property int $tovar_id
 * @property int $soni
 * @property string $create_data
 */
class Chiqim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chiqim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tovar_id', 'soni'], 'required'],
            [['tovar_id', 'soni'], 'integer'],
            [['create_data'], 'safe'],
            [['tovar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tovar::className(), 'targetAttribute' => ['tovar_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tovar_id' => 'Tovar ID',
            'soni' => 'Soni',
            'create_data' => 'Create Data',
        ];
    }
    public function getTovar()
    {
        return $this->hasOne(Tovar::className(), ['id' => 'tovar_id']);
    }
}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "qoldiq".
 *
 * @property int $id
 * @property int $tovar_id
 * @property int $soni
 * @property string $update_data
 *
 * @property Tovar $tovar
 */
class Qoldiq extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'qoldiq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tovar_id', 'soni'], 'required'],
            [['tovar_id', 'soni'], 'integer'],
            [['update_data'], 'safe'],
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
            'tovar_id' => 'Tovar nomi',
            'soni' => 'Qolgan tovarlar soni',
            'update_data' => 'Oxirgi o`zgartirilgan vaqt',
        ];
    }

    /**
     * Gets query for [[Tovar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTovar()
    {
        return $this->hasOne(Tovar::className(), ['id' => 'tovar_id']);
    }
}

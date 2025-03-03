<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "davlat".
 *
 * @property int $id
 * @property string $name
 *
 * @property Citees[] $citees
 * @property Citees[] $citees0
 */
class Davlat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'davlat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Citees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCitees()
    {
        return $this->hasMany(Citees::className(), ['davlat_id' => 'id']);
    }

    /**
     * Gets query for [[Citees0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCitees0()
    {
        return $this->hasMany(Citees::className(), ['davlat_id' => 'id']);
    }
}

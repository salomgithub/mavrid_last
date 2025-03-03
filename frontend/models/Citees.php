<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "citees".
 *
 * @property int $id
 * @property string $name
 * @property int $davlat_id
 *
 * @property Davlat $davlat
 * @property Davlat $davlat0
 */
class Citees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'citees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'davlat_id'], 'required'],
            [['davlat_id'], 'integer'],
            [['name'], 'string', 'max' => 10],
            [['davlat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Davlat::className(), 'targetAttribute' => ['davlat_id' => 'id']],
            [['davlat_id'], 'exist', 'skipOnError' => true, 'targetClass' => Davlat::className(), 'targetAttribute' => ['davlat_id' => 'id']],
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
            'davlat_id' => 'Davlat ID',
        ];
    }

    /**
     * Gets query for [[Davlat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDavlat()
    {
        return $this->hasOne(Davlat::className(), ['id' => 'davlat_id']);
    }

    /**
     * Gets query for [[Davlat0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDavlat0()
    {
        return $this->hasOne(Davlat::className(), ['id' => 'davlat_id']);
    }
}

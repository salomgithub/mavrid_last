<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tovar".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 *
 * @property Code[] $codes
 * @property Orders[] $orders
 * @property Warehouse[] $warehouses
 */
class Tovar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tovar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Mahsulot nomi',
            'price' => 'Narxi',
        ];
    }

    /**
     * Gets query for [[Codes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodes()
    {
        return $this->hasMany(Code::className(), ['tovar_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['tovar_id' => 'id']);
    }

    /**
     * Gets query for [[Warehouses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouses()
    {
        return $this->hasMany(Warehouse::className(), ['tovar_id' => 'id']);
    }
}

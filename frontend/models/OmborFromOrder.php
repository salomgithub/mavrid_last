<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ombor_from_order".
 *
 * @property int $id
 * @property int $order_id
 * @property int $soni
 * @property string $create_data
 *
 * @property Orders $order
 */
class OmborFromOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ombor_from_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'soni'], 'required'],
            [['order_id', 'soni'], 'integer'],
            [['create_data'], 'safe'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'soni' => 'Soni',
            'create_data' => 'Create Data',
        ];
    }

    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }
}

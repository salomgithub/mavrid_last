<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "worker".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $order_id
 * @property int $code_id
 * @property int $soni
 * @property string $date
 * @property int $narxi
 *
 * @property Code $code
 * @property Employees $employees
 * @property Orders $order
 */
class Worker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'worker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'order_id', 'code_id', 'soni'], 'required'],
            [['employee_id', 'order_id', 'code_id', 'soni', 'narxi'], 'integer'],
            [['date'], 'safe'],
            [['code_id'], 'exist', 'skipOnError' => true, 'targetClass' => Code::className(), 'targetAttribute' => ['code_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employee_id' => 'id']],
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
            'employee_id' => 'Familya',
            'order_id' => 'Buyurtma',
            'code_id' => 'Operatsiya turi',
            'soni' => 'Soni',
            'date' => 'Operatsiya bajarilgan vaqt',
            'narxi' => 'Operatsiya uchun belgilangan narxi',
        ];
    }

    /**
     * Gets query for [[Code]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCode()
    {
        return $this->hasOne(Code::className(), ['id' => 'code_id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasOne(Employees::className(), ['id' => 'employee_id']);
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

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $tovar_id
 * @property int $color_id
 * @property int $size_id
 * @property int $soni
 * @property int $brak_soni
 * @property string|null $date
 * @property int $status
 *
 * @property Color $color
 * @property Size $size
 * @property Tovar $tovar
 * @property Worker[] $workers
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tovar_id', 'color_id', 'size_id', 'soni'], 'required'],
            [['tovar_id', 'color_id', 'size_id', 'soni', 'brak_soni', 'status'], 'integer'],
            ['soni', 'compare', 'compareValue' => 1, 'operator' => '>=', 'message' => '"Buyurtma Soni" 1 dan kichik bo\'lishi mumkin emas.'],
            [['date'], 'safe'],
            [['color_id'], 'exist', 'skipOnError' => true, 'targetClass' => Color::className(), 'targetAttribute' => ['color_id' => 'id']],
            [['size_id'], 'exist', 'skipOnError' => true, 'targetClass' => Size::className(), 'targetAttribute' => ['size_id' => 'id']],
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
            'tovar_id' => 'Tovar turi',
            'color_id' => 'Rangi',
            'size_id' => 'O`lchami',
            'soni' => 'Soni',
            'brak_soni' => 'Braklar Soni',
            'date' => 'Buyurtma berilgan vaqt',
            'status' => 'Holati',
        ];
    }

    /**
     * Gets query for [[Color]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColor()
    {
        return $this->hasOne(Color::className(), ['id' => 'color_id']);
    }

    /**
     * Gets query for [[Size]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSize()
    {
        return $this->hasOne(Size::className(), ['id' => 'size_id']);
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

    /**
     * Gets query for [[Workers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Worker::className(), ['order_id' => 'id']);
    }
}

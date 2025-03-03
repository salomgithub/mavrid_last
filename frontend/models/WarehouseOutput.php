<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "warehouse_output".
 *
 * @property int $id
 * @property int $material_id
 * @property float $quantity
 * @property string $date_of_exit
 * @property string|null $destination
 * @property string|null $comments
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Materials $material
 */
class WarehouseOutput extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_output';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_id', 'quantity', 'date_of_exit'], 'required'],
            [['material_id'], 'integer'],
            [['quantity'], 'number'],
            [['date_of_exit', 'created_at', 'updated_at'], 'safe'],
            [['comments'], 'string'],
            [['destination'], 'string', 'max' => 255],
            [['material_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materials::className(), 'targetAttribute' => ['material_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'material_id' => 'Mahsulot nomi',
            'quantity' => 'Soni',
            'date_of_exit' => 'Chiqim sanasi',
            'destination' => 'Qayerga',
            'comments' => 'tarif',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Material]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMaterial()
    {
        return $this->hasOne(Materials::className(), ['id' => 'material_id']);
    }
}

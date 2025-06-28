<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "warehouse".
 *
 * @property int $id
 * @property int $material_id
 * @property string|null $color
 * @property float $total_stock
 * @property float $total_in
 * @property float|null $total_out
 * @property string $updated_at
 *
 * @property Materials $material
 */
class Warehouse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_id'], 'required'],
            [['material_id'], 'integer'],
            [['total_stock', 'total_in', 'total_out'], 'number'],
            [['updated_at'], 'safe'],
            [['color'], 'string', 'max' => 50],
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
            'material_id' => 'Material ID',
            'color' => 'Color',
            'total_stock' => 'Total Stock',
            'total_in' => 'Total In',
            'total_out' => 'Total Out',
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

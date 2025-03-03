<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "materials".
 *
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property string|null $color
 * @property string $unit
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property WarehouseInput[] $warehouseInputs
 * @property WarehouseOutput[] $warehouseOutputs
 */
class Materials extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materials';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'unit'], 'required'],
            [['unit'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 100],
            [['color'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nomi',
            'type' => 'Turi',
            'color' => 'Rangi',
            'unit' => 'Miqdor turi',
            'created_at' => 'Sana',
            'updated_at' => 'Updated At',
        ];
    }

    public function getMaterials()
    {
        return $this->hasOne(Materials::class, ['id' => 'material_id']);
    }

    /**
     * Gets query for [[WarehouseInputs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseInputs()
    {
        return $this->hasMany(WarehouseInput::className(), ['material_id' => 'id']);
    }

    /**
     * Gets query for [[WarehouseOutputs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWarehouseOutputs()
    {
        return $this->hasMany(WarehouseOutput::className(), ['material_id' => 'id']);
    }
}

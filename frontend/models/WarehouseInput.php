<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "warehouse_input".
 *
 * @property int $id
 * @property int $material_id
 * @property int $status
 * @property float $quantity
 * @property string $date_received
 * @property string|null $storage_location
 * @property string|null $comments
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Materials $material
 */
class WarehouseInput extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'warehouse_input';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['material_id', 'quantity', 'date_received', 'price', 'from_name', 'summa' , 'from_name'], 'required'],
            [['material_id', 'from_name', 'status', 'price', 'summa'], 'integer'],
            [['quantity'], 'number'],
            [['date_received', 'created_at', 'updated_at'], 'safe'],
            [['comments'], 'string'],
            [['storage_location'], 'string', 'max' => 255],
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
            'price' => 'narxi',
            'summa' => 'Jami summa',
            'date_received' => 'Kirim sanasi',
            'from_name' => 'Qayerdan',
            'storage_location' => 'Sklad',
            'comments' => 'tarif',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'holati',
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

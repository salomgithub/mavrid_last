<?php

namespace frontend\models;

use Yii;
use frontend\models\Tovar;

/**
 * This is the model class for table "code". Operatsiyalar ro`yxati
 *
 * @property int $id
 * @property int $tovar_id
 * @property string $code
 * @property int $price
 *
 * @property Tovar $tovar
 * @property Worker[] $workers
 */
class Code extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tovar_id', 'code', 'price'], 'required'],
            [['tovar_id', 'price'], 'integer'],
            [['code'], 'string', 'max' => 50],
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
            'tovar_id' => 'Tovar ID',
            'code' => 'Operatsiya nomi',
            'price' => 'Narxi',
        ];
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
        return $this->hasMany(Worker::className(), ['code_id' => 'id']);
    }

    // public function getTovar(){
    //     return $this->hasOne(Tovar::classname(),[
    //         'id'=>'tovar_id'
    //     ]);
    // } 
    //  public function getBank2(){
    //     return $this->hasOne(Regions::classname(),[
    //         'id'=>'region_id'
    //     ]);
    // } 
}

<?php

namespace frontend\models;

use frontend\models\Tovar;
use Yii;

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
class TovarCode extends \yii\db\ActiveRecord
{
//    public $assigned;    // tanlangan operatsiyalar (o'ngda)
//    public $available;   // mavjud operatsiyalar (chapda)
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tovar_code';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tovar_id', 'code_id'], 'required'],
            [['tovar_id', 'code_id'], 'integer'],
//            [['code'], 'string', 'max' => 50],
            [['tovar_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tovar::className(), 'targetAttribute' => ['tovar_id' => 'id']],
            [['code_id'], 'exist', 'skipOnError' => true, 'targetClass' => Code::className(), 'targetAttribute' => ['code_id' => 'id']],
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
            'code_id' => 'Operatsiya ID',
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

    public function getCodes()
    {
        return $this->hasOne(Tovar::className(), ['id' => 'code_id']);
    }

    /**
     * Gets query for [[Workers]].
     *
     * @return \yii\db\ActiveQuery
     */
//    public function getWorkers()
//    {
//        return $this->hasMany(Worker::className(), ['code_id' => 'id']);
//    }

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

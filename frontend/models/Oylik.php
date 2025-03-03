<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "oylik".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $code_summa
 * @property int $summa
 * @property string $data
 */
class Oylik extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'oylik';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'code_summa', 'summa'], 'required'],
            [['employee_id', 'code_summa', 'summa'], 'integer'],
            [['data'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'code_summa' => 'Code Summa',
            'summa' => 'Summa',
            'data' => 'Data',
        ];
    }
}

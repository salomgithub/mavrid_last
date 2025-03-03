<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "date".
 *
 * @property int $id
 * @property string $from_date
 * @property string $to_date
 */
class Date extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'date';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from_date', 'to_date'], 'required'],
            [['from_date', 'to_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_date' => 'Oylik hisoblash boshlangan kun',
            'to_date' => 'Oxirgi kun',
        ];
    }
}
 
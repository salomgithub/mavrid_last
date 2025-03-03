<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property int $id
 * @property int $company_id
 * @property int $user_id
 * @property int $branch_id
 * @property int $order_num
 * @property int $rating
 * @property string $time_rating
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'user_id', 'branch_id', 'order_num', 'rating'], 'required'],
            [['company_id', 'user_id', 'branch_id', 'order_num', 'rating'], 'integer'],
            [['time_rating'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'branch_id' => 'Branch ID',
            'order_num' => 'Order Num',
            'rating' => 'Rating',
            'time_rating' => 'Time Rating',
        ];
    }
}
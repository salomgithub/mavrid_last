<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $lastname
 * @property string $firstname
 * @property string $namefather
 * @property string $date
 * @property string $start_work
 * @property string $pasport
 * @property string $comment
 * @property int $status
 *
 * @property Worker[] $workers
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lastname', 'firstname', 'namefather', 'date', 'start_work', 'pasport'], 'required'],
            [['date', 'start_work'], 'safe'],
            [['status'], 'integer'],
            [['lastname', 'firstname', 'namefather'], 'string', 'max' => 20],
            [['pasport'], 'string', 'max' => 9],
            [['comment'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lastname' => 'Lastname',
            'firstname' => 'Firstname',
            'namefather' => 'Namefather',
            'date' => 'Date',
            'start_work' => 'Start Work',
            'pasport' => 'Pasport',
            'comment' => 'Comment',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Workers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkers()
    {
        return $this->hasMany(Worker::className(), ['employee_id' => 'id']);
    }
}

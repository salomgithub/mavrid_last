<?php

namespace frontend\models;

use yii\base\Model;

class ProductOperationForm extends Model
{
    public $product_id;
    public $assigned;    // tanlangan operatsiyalar (o'ngda)
    public $available;   // mavjud operatsiyalar (chapda)

    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['assigned', 'available'], 'safe'],
        ];
    }
}

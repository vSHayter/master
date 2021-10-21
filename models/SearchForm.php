<?php

namespace app\models;

use yii\base\Model;

/**
 * SearchForm is the model behind the search form.
 */
class SearchForm extends Model
{
    public $cityName;
    public $cityId;
    public $checkIn;
    public $checkOut;
    public $travelers;
    public $room;

    public function rules()
    {
        return [
            [['cityName' , 'checkIn', 'checkOut', 'travelers', 'room'], 'required'],
            [['checkIn', 'checkOut'], 'date', 'format' => 'php:Y-m-d'],
            [['travelers', 'room'], 'integer', 'min' => 1],
            [['travelers'], 'integer', 'max' => 30],
            [['room'], 'integer', 'max' => 15],
        ];
    }
}

<?php

namespace app\widgets;

use app\models\SearchForm;
use DateTime;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * Widget for searching by parameters
 */

class SearchWidget extends Widget
{
    public $model;
    public $options = [];
    public $defaultOptions = [
        'type' => 'main',
        'method' => 'get',
        'action' => 'hotel/index',
    ];

    public function init()
    {
        if(empty($this->options)) {
            $this->options = $this->defaultOptions;
        } else {
            $this->options = ArrayHelper::merge($this->defaultOptions, $this->options);
        }

        if(!isset($this->model)) {
            $this->model = new SearchForm();
            $dateTime = new DateTime();
            $this->model->checkIn = $dateTime->modify('+7 days')->format('Y-m-d');
            $this->model->checkOut = $dateTime->modify('+1 days')->format('Y-m-d');
            $this->model->travelers = 2;
            $this->model->room = 1;
        }
    }

    public function run()
    {
        return $this->render('search', [
            'model' => $this->model,
            'options' => $this->options,
        ]);
    }

}
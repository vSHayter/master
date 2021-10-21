<?php

namespace app\widgets;

use app\models\SearchForm;
use yii\base\Widget;

/**
 * Widget for searching by parameters
 */

class SearchWidget extends Widget
{
    public $model;
    public $type;

    public function init()
    {
        if(!isset($this->type))
            $this->type = 'main';
        if(!isset($this->model)) {
            $this->model = new SearchForm();
            $this->model->checkIn = date("Y-m-d", mktime(0,0,0, date("m"), date("d")+7, date("Y")));
            $this->model->checkOut = date("Y-m-d", mktime(0,0,0, date("m"), date("d")+8, date("Y")));
            $this->model->travelers = 2;
            $this->model->room = 1;
        } else {
            $this->model = new SearchForm($this->model);
        }

    }

    public function run()
    {
        return $this->render('search', [
            'model' => $this->model,
            'type' => $this->type
        ]);
    }

}
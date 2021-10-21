<?php

namespace app\widgets;

use yii\base\Widget;

/**
 * Widget parameters
 */

class ParametersWidget extends Widget
{
    public $room;
    public $travelers;

    public function run()
    {
        return $this->render('parameter-modal', [
            'room' => $this->room,
            'travelers' => $this->travelers
        ]);
    }
}

<?php

namespace app\controllers;

use app\models\Feedback;
use Yii;
use yii\web\Controller;

class FeedbackController extends Controller
{
    public function actionReview()
    {
        $values = [
            'feedback' => $_POST['user-feedback'],
            'rating' => $_POST['user-rating'],
            'date' => date("Y-m-d"),
            'id_booking' => $_POST['booking'],
            'id_hotel' => $_POST['hotel']
        ];

        $feedback = new Feedback();
        $feedback->attributes = $values;
        $feedback->save();

        return $this->redirect(Yii::$app->request->referrer);
    }
}

<?php

namespace app\controllers;

use app\models\Booking;
use Yii;
use yii\web\Controller;

class BookingController extends Controller
{
    public function actionBooking()
    {
        $values = [
            'date_booking' => date("Y-m-d"),
            'date_start' => $_POST['checkIn'],
            'date_end' => $_POST['checkOut'],
            'wishes' => $_POST['wishes'],
            'amount_room' => $_POST['amount_room'],
            'amount_people' => $_POST['travelers'],
            'status' => 0,
            'id_user' => Yii::$app->user->id,
            'id_room' => $_POST['idRoom']
        ];

        $booking = new Booking();
        $booking->attributes = $values;
        $booking->save();

        return $this->redirect(Yii::$app->request->referrer);
    }
}
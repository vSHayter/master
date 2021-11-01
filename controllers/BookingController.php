<?php

namespace app\controllers;

use app\models\Booking;
use app\models\IndexHotelService;
use app\models\Room;
use DateTime;
use Exception;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class BookingController extends Controller
{

    /**
     * Booking action.
     *
     * @return Response | string
     * @throws Exception
     */
    public function actionBooking()
    {
        $array = Yii::$app->request->post()['Booking'];

        $room = new Room();
        $result = $room->checkRoomAvailability($array['id_room'], $array['date_start'], $array['date_end']);
        if($result) {
            if ($array['amount_room'] < $result) {

                $start = new DateTime($array['date_start']);
                $end = new DateTime($array['date_end']);
                $count = $start->diff($end);

                $room = $room::find()->where(['id' => $array['id_room']])->one();
                $array['total'] = $room->cost * $count->days;

                $booking = new Booking();

                if ($booking->load($array, ''))
                    $booking->save();

                return $this->goBack(Yii::$app->request->referrer);
            } else {
                return $this->render('../site/error', [
                    'name' => 'Error',
                    'message' => 'There are fewer available rooms than you need'
                ]);
            }
        } else {
            return $this->render('../site/error', [
                'name' => 'Error',
                'message' => 'No available rooms'
            ]);
        }

    }
}
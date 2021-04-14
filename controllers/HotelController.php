<?php


namespace app\controllers;

use app\models\Booking;
use app\models\Hotel;
use app\models\User;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;


class HotelController extends Controller
{
    public function actionIndex()
    {
        $values = [
            'checkIn' => Yii::$app->request->get('checkIn'),
            'checkOut' => Yii::$app->request->get('checkOut'),
            'room' => Yii::$app->request->get('room'),
            'travelers' => Yii::$app->request->get('travelers'),
            'cityId' => Yii::$app->request->get('cityId'),
            'cityName' => Yii::$app->request->get('cityName')
        ];

        $query = Hotel::find()->where(['status' => 1]);

        if ($values['cityId'] != null)
            $query->where(['id_city' => $values['cityId']]);
        elseif ($values['cityName'] != null) {
            $query->joinWith('city')
                ->where(['city.name' => $values['cityName']]);
        }

        $query = $query->all();

        $user = User::findOne(Yii::$app->user->id);

        return $this->render('index', [
            'hotels' => $query,
            'user' => $user,
        ]);
    }

    public function actionSingle($idHotel)
    {
        $query = Hotel::find()->where(['id' => $idHotel])->one();

        //For feedback if user booking room in hotel
        $booking = Booking::find()->joinWith('room')
            ->where(['id_user' => Yii::$app->user->id])
            ->andWhere(['id_hotel' => $idHotel])
            ->andWhere(['status' => 1])
            ->orderBy('date_end DESC')
            ->limit(1)
            ->one();


        return $this->render('single', [
            'hotel' => $query,
            'booking' => $booking,
        ]);
    }
}
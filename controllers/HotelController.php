<?php

namespace app\controllers;

use app\models\Booking;
use app\models\Hotel;
use app\models\ServiceHotel;
use app\models\TypeHotel;
use app\models\User;
use Yii;
use yii\web\Controller;


class HotelController extends Controller
{

    /**
     * Displays hotels page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $types = TypeHotel::find()->all();
        $services = ServiceHotel::find()->all();
        $user = User::findOne(Yii::$app->user->id);

        $values = [
            'checkIn' => Yii::$app->request->get('checkIn'),
            'checkOut' => Yii::$app->request->get('checkOut'),
            'room' => Yii::$app->request->get('room'),
            'travelers' => Yii::$app->request->get('travelers'),
            'cityId' => Yii::$app->request->get('cityId'),
            'cityName' => Yii::$app->request->get('cityName')
        ];

        $query = Hotel::find()->where(['status' => 1])
            ->joinWith(['city'])
            ->andFilterWhere(['id_city' => $values['cityId']])
            ->andFilterWhere(['city.name' => current(explode(',', $values['cityName']))])
            ->limit(3)
            ->all();

        return $this->render('index', [
            'hotels' => $query,
            'user' => $user,
            'services' => $services,
            'types' => $types,
            'reccomend' => 0
        ]);
    }

    /**
     * Displays single hotel page.
     *
     * @param $idHotel
     * @return string
     */
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
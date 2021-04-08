<?php


namespace app\controllers;

use app\models\Booking;
use app\models\Hotel;
use app\models\User;
use Yii;
use yii\web\Controller;


class HotelController extends Controller
{
    public function actionIndex()
    {
        $values = [
            'dateStart' => Yii::$app->request->get('dateStart'),
            'dateEnd' => Yii::$app->request->get('dateEnd'),
            'params' => Yii::$app->request->get('params'),
        ];

        $cityId = Yii::$app->request->get('cityId');
        $cityName = Yii::$app->request->get('cityName');

        if ($cityId != null) {
            $values += ['city' => $cityId];

            $query = Hotel::find()
                ->where(['id_city' => $values['city']]);
        }
        elseif ($cityName != null) {
            $values += ['city' => $cityName];

            $query = Hotel::find()
                ->joinWith('city')
                ->where(['city.name' => $values['city']]);
        }

        $query = $query->andWhere(['status' => 1])->all();

        //$query = Hotel::find()->all();

        $user = User::findOne(Yii::$app->user->id);

        return $this->render('index', [
            'hotels' => $query,
            'user' => $user
        ]);
    }

    public function actionSingle($id)
    {
        $query = Hotel::find()->where(['id' => $id])->one();

        $booking = Booking::find()->joinWith('room')
            ->where(['id_user' => Yii::$app->user->id])
            ->andWhere(['id_hotel' => $id])
            ->andWhere(['status' => 1])
            ->orderBy('date_end DESC')
            ->limit(1)
            ->one();

        return $this->render('single', [
            'hotel' => $query,
            'booking' => $booking
        ]);
    }
}
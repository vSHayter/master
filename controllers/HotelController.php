<?php

namespace app\controllers;

use app\models\Booking;
use app\models\Hotel;
use app\models\SearchForm;
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

        $searchForm = new SearchForm();
        $searchForm->load(Yii::$app->request->get());

        $query = Hotel::find()->where(['status' => 1])
            ->joinWith(['city'])
            ->andFilterWhere(['id_city' => $searchForm['cityId']])
            ->andFilterWhere(['city.name' => current(explode(',', $searchForm['cityName']))])
            ->limit(3)
            ->all();

        return $this->render('index', [
            'hotels' => $query,
            'user' => $user,
            'services' => $services,
            'types' => $types,
            'searchForm' => $searchForm,
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

        $searchForm = new SearchForm();
        $searchForm->load(Yii::$app->request->get());

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
            'searchForm' => $searchForm,
        ]);
    }
}
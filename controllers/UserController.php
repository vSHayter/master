<?php

namespace app\controllers;

use app\models\Booking;
use app\models\Favourite;
use app\models\Feedback;
use app\models\User;
use Yii;
use yii\web\Controller;


class UserController extends Controller
{

    public function actionLike()
    {
        if (isset($_POST['id'])) {
            $idHotel = $_POST['id'];
            $idUser = \Yii::$app->user->id;

            $query = Favourite::find()
                ->where(['id_hotel' => $idHotel])
                ->andWhere(['id_user' => $idUser])
                ->one();

            if ($query == null) {
                $like = new Favourite();
                $like->id_hotel = $idHotel;
                $like->id_user = $idUser;
                $like->save();
            } else {
                $query->delete();
            }
        }
    }

    /**
     * Displays favourite user page.
     *
     * @return string
     */
    public function actionFavourites()
    {
        $query = Favourite::find()->where(['id_user' => Yii::$app->user->id])->all();

        $user = User::findOne(Yii::$app->user->id);

        if($query) {
            return $this->render('favourites', [
                'favourites' => $query,
                'user' => $user,
            ]);
        } else {
            return $this->render('/site/error', [
                'message' => "You have not liked any hotel",
                'name' => "Oops"
            ]);
        }
    }

    /**
     * Displays history user trips page.
     *
     * @return string
     */
    public function actionTrips()
    {
        $query = Booking::find()->where(['id_user' => Yii::$app->user->id])->orderBy('status')->all();

        return $this->render('trips', [
                'trips' => $query,
            ]);
    }

    /**
     * Displays history user feedbacks page.
     *
     * @return string
     */
    public function actionFeedbacks()
    {
        $query = Feedback::find()->joinWith('booking')->where(['id_user' => Yii::$app->user->id])->all();

        return $this->render('feedbacks', [
            'feedbacks' => $query
        ]);
    }


    public function actionRatings()
    {
        return $this->render('rating', [
        ]);
    }

}

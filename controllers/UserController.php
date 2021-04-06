<?php

namespace app\controllers;

use app\models\Like;
use yii\web\Controller;


class UserController extends Controller
{
    public function actionLike()
    {
        if (isset($_POST['id'])) {
            $idHotel = $_POST['id'];
            $idUser = \Yii::$app->user->id;

            $query = Like::find()
                ->where(['id_hotel' => $idHotel])
                ->andWhere(['id_user' => $idUser])
                ->one();

            if ($query == null) {
                $like = new Like();
                $like->id_hotel = $idHotel;
                $like->id_user = $idUser;
                $like->save();
                echo 'Liked';
            } else {
                $query->delete();
                echo 'Delete Liked';
            }
        }
    }
}

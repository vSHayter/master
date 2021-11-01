<?php

namespace app\controllers;

use app\models\Room;
use Yii;
use yii\web\Controller;


class RoomController extends Controller
{
    /**
     * Display room info in modal.
     *
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {
        if(Yii::$app->request->post('roomId')) {
            $room = Room::find()->where(['id' => Yii::$app->request->post('roomId')])->one();

            return $this->renderAjax('index', [
                'room' => $room
            ]);
        } else {
            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }
    }
}
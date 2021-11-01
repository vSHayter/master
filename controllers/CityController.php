<?php

namespace app\controllers;

use app\models\City;
use Yii;
use yii\web\Controller;

class CityController extends Controller
{
    /**
     * Search city action.
     *
     * @return string
     */
    public function actionSearch()
    {
        if (Yii::$app->request->post('search')) {

            $name = Yii::$app->request->post('search');

            $citys = City::find()
                ->where(['like', 'name', $name . '%', false])
                ->limit(10)
                ->all();

            return $this->renderAjax('index', [
                    'citys' => $citys
            ]);
        } else {
            return $this->render('/');
        }
    }
}

<?php

namespace app\controllers;

use app\models\Feedback;
use Yii;
use yii\web\Controller;

class FeedbackController extends Controller
{

    /**
     * Review action.
     *
     * @return \yii\web\Response
     */
    public function actionReview()
    {
        $model = new Feedback();

        if ($model->load(Yii::$app->request->post(), 'Feedback')) {
            $model->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }
}

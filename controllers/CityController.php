<?php

namespace app\controllers;

use app\models\City;
use yii\web\Controller;

class CityController extends Controller
{
    public function actionSearch()
    {
        if (isset($_POST['search'])) {

            $name = $_POST['search'];

            $query = City::find()
                ->where(['like', 'name', $name . '%', false])
                ->limit(10)
                ->all();

            echo '<ul>';

            foreach ($query as $city): ?>
                <li onclick='fillCityName("<?= $city['name']; ?>"); fillCityId("<?= $city['id']; ?>");'>
                    <a>
                        <?= $city->name . '(' . $city->country->name . ')' ?>
                    </a>
                </li>
            <?php endforeach;
        }
    }
}

<?php

namespace app\migrations\faker;

use app\models\City;
use app\models\TypeHotel;
use Faker\Factory;
use Yii;
use yii\db\Migration;

/**
 * Class M210315100532FakerHotel
 */
class M210315100532FakerHotel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $type = TypeHotel::find()->all();
        $faker = Factory::create();

        $count = 0;
        $hotels = [];
        for($i = 0; $i < 100; $i++) {
            $hotels[] = [
                $faker->name(),
                $faker->text(100),
                $faker->phoneNumber,
                rand(1, 1000),
                $faker->address,
                rand(10000, 99999),
                rand(0, 1),
                rand(1, count($type)),
                rand(1, 2853334),
            ];
            $count++;
        }

        Yii::$app->db->createCommand()->batchInsert('hotel',
            ['name', 'description', 'phone_number', 'house_number',
                'address', 'index', 'status', 'id_type', 'id_city'], $hotels)->execute();

        echo "Create $count hotels";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('hotel')->query();
    }
}

<?php

namespace app\migrations\faker;

use app\models\Hotel;
use app\models\TypeRoom;
use Faker\Factory;
use Yii;
use yii\db\Migration;

/**
 * Class M210315100538FakerRoom
 */
class M210315100538FakerRoom extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $type = TypeRoom::find()->all();
        $hotel = Hotel::find()->all();
        $faker = Factory::create();

        $count = 0;
        $rooms = [];
        for($i = 0; $i < 200; $i++) {
            $rooms[] = [
                rand(1, 8),
                $faker->randomFloat(2, 10, 9999),
                rand(20, 150),
                rand(1, 10),
                $faker->text(100),
                rand(1, count($type)),
                rand(1, count($hotel)),
            ];
            $count++;
        }

        Yii::$app->db->createCommand()->batchInsert('room',
            ['amount_people', 'cost', 'area', 'amount_room',
                'description', 'id_type', 'id_hotel'], $rooms)->execute();

        echo "Create $count rooms";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('room')->query();
    }

}

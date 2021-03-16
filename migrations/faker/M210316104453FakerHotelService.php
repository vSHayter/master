<?php

namespace app\migrations\faker;

use app\models\Hotel;
use app\models\ServiceHotel;
use Yii;
use yii\db\Migration;

/**
 * Class M210316104453FakerHotelService
 */
class M210316104453FakerHotelService extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $service = ServiceHotel::find()->all();
        $hotel = Hotel::find()->all();

        $count = 0;
        $hotelService = [];
        for($i = 0; $i < 200; $i++) {
            $hotelService[] = [
                rand(1, count($hotel)),
                rand(1, count($service)),
                rand(0, 1)
            ];
            $count++;
        }

        Yii::$app->db->createCommand()->batchInsert('index_hotel_service',
            ['id_hotel', 'id_service', 'payment'], $hotelService)->execute();

        echo "Create $count hotel service";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('index_hotel_service')->query();
    }

}

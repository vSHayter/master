<?php

namespace app\migrations\faker;

use app\models\Hotel;
use app\models\ParameterType;
use Yii;
use yii\db\Migration;

/**
 * Class M210316104503FakerHotelParameter
 */
class M210316104503FakerHotelParameter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $parameter = ParameterType::find()->all();
        $hotel = Hotel::find()->all();

        $count = 0;
        $hotelParameter = [];
        for($i = 0; $i < 200; $i++) {
            $hotelParameter[] = [
                rand(1, 50),
                rand(3, 4),
                rand(1, 5)
            ];
            $count++;
        }

        Yii::$app->db->createCommand()->batchInsert('hotel_parameter',
            ['id_hotel', 'id_parameter', 'value'], $hotelParameter)->execute();

        echo "Create $count hotel parameter";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('hotel_parameter')->query();
    }

}

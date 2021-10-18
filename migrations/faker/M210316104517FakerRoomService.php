<?php

namespace app\migrations\faker;

use app\models\Room;
use app\models\ServiceRoom;
use Yii;
use yii\db\Migration;

/**
 * Class M210316104517FakerRoomService
 */
class M210316104517FakerRoomService extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $service = ServiceRoom::find()->all();
        $room = 1;
        $count = 0;
        $roomService = [];
        for($i = 0; $i < 500; $i++) {
            $roomService[] = [
                $room++,
                rand(1, count($service)),
            ];
            if ($room > 30)
                $room = 1;
            $count++;
        }

        Yii::$app->db->createCommand()->batchInsert('index_room_service',
            ['id_room', 'id_service'], $roomService)->execute();

        echo "Create $count room service";
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('index_room_service')->query();
    }
}

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
        $room = Room::find()->all();

        $count = 0;
        $roomService = [];
        for($i = 0; $i < 200; $i++) {
            $roomService[] = [
                rand(1, count($room)),
                rand(1, count($service)),
            ];
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

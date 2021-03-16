<?php

namespace app\migrations\faker;

use Yii;
use yii\db\Migration;

/**
 * Class M210315100223FakerCaregoryRoomService
 */
class M210315100223FakerCaregoryRoomService extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $category = [
            ['Удобства в номере'],
            ['Ванная комната'],
            ['Медиа и технологии'],
            ['Питание и напитки'],
            ['Услуги и дополнения'],
            ['Снаружи'],
            ['Доступность'],
            ['Развлечения и семейные услуги'],
        ];

        Yii::$app->db->createCommand()->batchInsert('category_room_service', ['name'], $category)->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('category_room_service')->query();
    }
}

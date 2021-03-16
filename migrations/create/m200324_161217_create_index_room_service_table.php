<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Связывающая таблица номера с услугами (удобствами)
 */
class m200324_161217_create_index_room_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%index_room_service}}', [
            'id' => $this->primaryKey(),
            'id_room' => $this->integer(),
            'id_service' => $this->integer()
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_room_service',
            'index_room_service',
            'id_room',
            'room',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_service_room',
            'index_room_service',
            'id_service',
            'service_room',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_room_service', 'index_room_service');
        $this->dropForeignKey('fk_service_room', 'index_room_service');

        $this->dropTable('{{%index_room_service}}');
    }
}

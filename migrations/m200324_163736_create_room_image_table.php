<?php

use yii\db\Migration;

/**
 * Промежуточная таблица для фотографий номера
 */
class m200324_163736_create_room_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room_image}}', [
            'id' => $this->primaryKey(),
            'id_room' => $this->integer()->defaultValue(0),
            'image' => $this->string()->defaultValue(null)
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_room_image',
            'room_image',
            'id_room',
            'room',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_room_image', 'room_image');

        $this->dropTable('{{%room_image}}');
    }
}

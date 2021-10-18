<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Таблица бронирований
 */
class m200316_135531_create_booking_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%booking}}', [
            'id' => $this->primaryKey(),
            'date_booking' => $this->date(),
            'date_start' => $this->date(),
            'date_end' => $this->date(),
            'wishes' => $this->text(), //пожелания
            'amount_room' => $this->integer(),
            'amount_people' => $this->integer(),
            'total' => $this->integer(), //итоговая сумма
            'status' => $this->integer()->defaultValue(0), //старус бронирования
            'id_user' => $this->integer(),
            'id_room' => $this->integer(),
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_booking_user',
            'booking',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_booking_room',
            'booking',
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
        $this->dropForeignKey('fk_booking_room', 'booking');
        $this->dropForeignKey('fk_booking_user', 'booking');

        $this->dropTable('{{%booking}}');
    }
}

<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m200316_135050_create_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%room}}', [
            'id' => $this->primaryKey(),
            'amount_people' => $this->integer(3), //кол-во человек
            'cost' => $this->float(), //стоимость за ночь
            'area' => $this->integer(5)->defaultValue('0'), //площадь
            'amount_room' => $this->integer()->defaultValue('0'), //кол-во таких номеров
            'description' => $this->text(), //описание номера
            'id_type' => $this->integer(),
            'id_hotel' => $this->integer()
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_room_type',
            'room',
            'id_type',
            'type_room',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_room_hotel',
            'room',
            'id_hotel',
            'hotel',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_room_hotel', 'room');
        $this->dropForeignKey('fk_room_type', 'room');

        $this->dropTable('{{%room}}');
    }
}

<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Таблица отелей
 */
class m200316_131213_create_hotel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hotel}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            //'stars' => $this->integer(),
            'phone_number' => $this->string(),
            'house_number' => $this->string(),
            'address' => $this->string()->defaultValue('0'),
            'index' => $this->integer(),
            'status' => $this->integer(),
            'id_type' => $this->integer()->defaultValue(0),
            'id_city' => $this->integer()->defaultValue(0),
//            'id_user' => $this->integer()->defaultValue(1)
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_hotel_type',
            'hotel',
            'id_type',
            'type_hotel',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_hotel_city',
            'hotel',
            'id_city',
            'city',
            'id',
            'CASCADE'
        );

//        $this->addForeignKey(
//            'fk_hotel_user',
//            'hotel',
//            'id_user',
//            'user',
//            'id',
//            'CASCADE'
//        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_hotel_type', 'hotel');
        $this->dropForeignKey('fk_hotel_city', 'hotel');

//        $this->dropForeignKey('fk_hotel_user', 'hotel');

        $this->dropTable('{{%hotel}}');
    }
}

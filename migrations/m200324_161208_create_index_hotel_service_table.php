<?php

use yii\db\Migration;

/**
 * Промежуточная таблица для связи отеля с услугами отеля
 */
class m200324_161208_create_index_hotel_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%index_hotel_service}}', [
            'id' => $this->primaryKey(),
            'id_hotel' => $this->integer(),
            'id_service' => $this->integer(),
            'payment' => $this->integer()->defaultValue(0) //тип услуги (бесплатно = 0/ платно = 1)
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_hotel_service',
            'index_hotel_service',
            'id_hotel',
            'hotel',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_service_hotel',
            'index_hotel_service',
            'id_service',
            'service_hotel',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_service_hotel', 'index_hotel_service');
        $this->dropForeignKey('fk_hotel_service', 'index_hotel_service');

        $this->dropTable('{{%index_hotel_service}}');
    }
}

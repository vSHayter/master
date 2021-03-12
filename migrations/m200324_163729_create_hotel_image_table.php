<?php

use yii\db\Migration;

/**
 * Промежуточная таблица для фотографий отеля
 */
class m200324_163729_create_hotel_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hotel_image}}', [
            'id' => $this->primaryKey(),
            'id_hotel' => $this->integer()->defaultValue(0),
            'image' => $this->string()->defaultValue(null),
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_hotel_image',
            'hotel_image',
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
        $this->dropForeignKey('fk_hotel_image', 'hotel_image');

        $this->dropTable('{{%hotel_image}}');
    }
}

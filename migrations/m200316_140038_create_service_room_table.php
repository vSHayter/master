<?php

use yii\db\Migration;

/**
 * Таблица существующих услуг (удобств) для номеров
 */
class m200316_140038_create_service_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_room}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'id_category' => $this->integer()
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_service_room_category',
            'service_room',
            'id_category',
            'category_room_service',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_service_room_category', 'service_room');

        $this->dropTable('{{%service_room}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Таблица существующих услуг гостиниц
 */
class m200316_140037_create_service_hotel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_hotel}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ], 'engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%service_hotel}}');
    }
}

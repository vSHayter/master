<?php

use yii\db\Migration;

/**
 * Таблица типов отелей
 */
class m200316_123138_create_type_hotel_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_hotel}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], 'engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_hotel}}');
    }
}

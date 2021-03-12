<?php

use yii\db\Migration;

/**
 * Таблица типов номеров
 */
class m200316_123258_create_type_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_room}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], 'engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_room}}');
    }
}

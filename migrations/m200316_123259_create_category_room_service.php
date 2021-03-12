<?php

use yii\db\Migration;

/**
 * Таблица категорий для услуг (удобств) доступных в номерах
 */
class m200316_123259_create_category_room_service extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_room_service}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ], 'engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_room_service}}');
    }
}

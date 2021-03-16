<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Таблица типов номеров
 */
class m200316_123259_create_type_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_room}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'id_category' => $this->integer()
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_type_room_category',
            'type_room',
            'id_category',
            'category_type_room',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_type_room_category', 'type_room');

        $this->dropTable('{{%type_room}}');
    }
}

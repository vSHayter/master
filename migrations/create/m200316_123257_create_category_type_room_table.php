<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Class m200316_123257_create_category_type_room_table
 */
class m200316_123257_create_category_type_room_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_type_room}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()
        ], 'engine=InnoDB');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_type_room}}');
    }
}

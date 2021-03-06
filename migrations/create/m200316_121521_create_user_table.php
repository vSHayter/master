<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Таблица пользователей
 */
class m200316_121521_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(20),
            'name' => $this->string(30),
            'surname' => $this->string(30)->defaultValue(null),
            'patronymic' => $this->string(30)->defaultValue(null),
            'phone' => $this->string(20),
            'email' => $this->string(),
            'password_hash' => $this->string(),
            'status' => $this->integer()->defaultValue(0)
        ], 'engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}

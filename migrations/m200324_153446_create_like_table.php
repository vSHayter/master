<?php

use yii\db\Migration;

/**
 * Таблица для понравившегося пользователю
 */
class m200324_153446_create_like_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%like}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_hotel' => $this->integer(),
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_like_user',
            'like',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_like_hotel',
            'like',
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
        $this->dropForeignKey('fk_like_user', 'like');
        $this->dropForeignKey('fk_like_hotel', 'like');

        $this->dropTable('{{%like}}');
    }
}

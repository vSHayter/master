<?php

use yii\db\Migration;

/**
 * Таблица для избранного пользователем
 */
class m200324_153436_create_favourite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%favourite}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer(),
            'id_hotel' => $this->integer(),
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_favourite_user',
            'favourite',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_favourite_hotel',
            'favourite',
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
        $this->dropForeignKey('fk_favourite_hotel', 'favourite');
        $this->dropForeignKey('fk_favourite_user', 'favourite');

        $this->dropTable('{{%favourite}}');
    }
}

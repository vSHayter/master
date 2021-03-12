<?php

use yii\db\Migration;

/**
 * Таблица городов
 */
class m200316_122916_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'id_country' => $this->integer()->defaultValue(0)
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_city_country',
            'city',
            'id_country',
            'country',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_city_country', 'city');

        $this->dropTable('{{%city}}');
    }
}

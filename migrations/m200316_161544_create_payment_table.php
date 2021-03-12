<?php

use yii\db\Migration;

/**
 * Заглушка для оплаты заказа
 */
class m200316_161544_create_payment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'status' => $this->integer()->defaultValue(0),
            'id_booking' => $this->integer()
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_payment_booking',
            'payment',
            'id_booking',
            'booking',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_payment_booking', 'payment');

        $this->dropTable('{{%payment}}');
    }
}

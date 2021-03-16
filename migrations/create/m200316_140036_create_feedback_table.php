<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Таблица отзывов пользователей об отелях
 */
class m200316_140036_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'feedback' => $this->text()->defaultValue(null),
            'rating' => $this->float()->defaultValue(0),
            'date' => $this->date(),
            'id_booking' => $this->integer(),
            'id_hotel' => $this->integer()
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_feedback_booking',
            'feedback',
            'id_booking',
            'booking',
            'id',
            'CASCADE');

        $this->addForeignKey(
            'fk_feedback_hotel',
            'feedback',
            'id_hotel',
            'hotel',
            'id',
            'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_feedback_booking', 'feedback');
        $this->dropForeignKey('fk_feedback_hotel', 'feedback');

        $this->dropTable('{{%feedback}}');
    }
}

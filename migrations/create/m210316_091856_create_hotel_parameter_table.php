<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Class m210316091856createhotelparametertable
 */
class m210316_091856_create_hotel_parameter_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hotel_parameter}}', [
            'id' => $this->primaryKey(),
            'id_hotel' => $this->integer(),
            'id_parameter' => $this->integer(),
            'value' => $this->string()
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_hotel_parameter_hotel',
            'hotel_parameter',
            'id_hotel',
            'hotel',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_hotel_parameter_parameter',
            'hotel_parameter',
            'id_parameter',
            'parameter_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_hotel_parameter_hotel', 'hotel_parameter');
        $this->dropForeignKey('fk_hotel_parameter_parameter', 'hotel_parameter');

        $this->dropTable('{{%hotel_parameter}}');
    }
}

<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Class m210316091832createparametertypetable
 */
class m210316_091832_create_parameter_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%parameter_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'id_type' => $this->integer()
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_parameter_type',
            'parameter_type',
            'id_type',
            'type_hotel',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_parameter_type', 'parameter_type');

        $this->dropTable('{{%parameter_type}}');
    }
}

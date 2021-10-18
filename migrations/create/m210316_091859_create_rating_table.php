<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Class m210316091859createratingtable
 */
class m210316_091859_create_rating_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rating}}', [
            'id_user' => $this->integer(),
            'id_hotel' => $this->integer(),
            'rating' => $this->float(),
            'timestamp' => $this->string()->defaultValue(null),
        ], 'engine=InnoDB');

        $this->addForeignKey(
            'fk_rating_user',
            'rating',
            'id_user',
            'user',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_rating_hotel',
            'rating',
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
        $this->dropTable('{{%rating}}');
    }
}

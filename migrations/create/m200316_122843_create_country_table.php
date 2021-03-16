<?php

namespace app\migrations\create;

use yii\db\Migration;

/**
 * Таблица стран
 */
class m200316_122843_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%country}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
        ], 'engine=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%country}}');
    }
}

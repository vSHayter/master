<?php

namespace app\migrations\faker;

use Yii;
use yii\db\Migration;

/**
 * Class M210315100044FakerParameterType
 */
class M210315100044FakerParameterType extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $parameter = [
            //вилла
            ['Количество спален', 2],
            ['Количество ванных конат', 2],

            //отель
            ['звезд', 11],
            ['рейтинг', 11],
        ];

        Yii::$app->db->createCommand()->batchInsert('parameter_type', ['name', 'id_type'], $parameter)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('parameter_type')->query();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M210315100044FakerPatameterType cannot be reverted.\n";

        return false;
    }
    */
}

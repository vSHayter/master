<?php

namespace app\migrations\faker;

use Yii;
use yii\db\Migration;

/**
 * Class M210315100126FakerCategoryTypeRoom
 */
class M210315100126FakerCategoryTypeRoom extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //category for hotel room
        $category = [
            ['Одноместный'],
            ['Двухместный с 1 кроватью'],
            ['Двухместный с 2 отдельными кроватями'],
            ['Двухместный с 1 кроватью или 2 отдельными кроватями'],
            ['Трехместный'],
            ['Четырехместны'],
            ['Семейный'],
            ['Люкс'],
            ['Номер-студио'],
            ['Апартаменты'],
            ['Общий номер'],
            ['Кровать в общем номере'],
        ];

        Yii::$app->db->createCommand()->batchInsert('category_type_room', ['name'], $category)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('category_type_room')->query();
    }

}

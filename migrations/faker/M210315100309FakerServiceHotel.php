<?php

namespace app\migrations\faker;

use Yii;
use yii\db\Migration;

/**
 * Class M210315100309FakerServiceHotel
 */
class M210315100309FakerServiceHotel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $service = [
            ['Бесплатный Wi-Fi'],
            ['Ресторан'],
            ['Доставка еды и напитков в номер'],
            ['Бар'],
            ['Круглосуточная стойка регистрации'],
            ['Сауна'],
            ['Фитнес-центр'],
            ['Сад'],
            ['Терраса'],
            ['Номера для некурящих'],
            ['Трансфер от/до аэропорта'],
            ['Семейные номера'],
            ['Спа и оздоровительный центр'],
            ['Гидромассажная ванна/джакузи'],
            ['Кондиционер'],
            ['Аквапарк'],
            ['Бассейн'],
        ];

        Yii::$app->db->createCommand()->batchInsert('service_hotel', ['name'], $service)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('service_hotel')->query();
    }

}

<?php

namespace app\migrations\faker;

use Yii;
use yii\db\Migration;

/**
 * Class M210315100043FakerTypeHotel
 */
class M210315100040FakerTypeHotel extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $types = [
            ['Апартаменты', 'Меблированное помещение с собственной кухней, предназначенное для краткосрочной и долговременной аренды'],
            ['Вилла', 'Отдельно стоящий дом повышенной комфортности с собственной кухней'],
            ['Гостевой дом', 'Частный дом, в котором предусмотрены отдельные удобства для гостей и для хозяина'],
            ['Дом для отпуска', 'Отдельно стоящий дом с собственным входом, обычно сдается для проведения отпуска'],
            ['Загородный дом', 'Частный дом с простым набором удобств, расположенный в сельской местности'],
            ['Курорт', 'Место для отдыха с ресторанами и развлечениями, обычно ассоциируется с роскошью'],
            ['Капсульный отель', 'Простой и недорогой вариант проживания в небольших спальных отсеках или ячейках'],
            ['Лодж', 'Частный дом, расположенный на природе, например, в горах или в лесу'],
            ['Мини-гостиница', 'Небольшая гостиница с минимальными набором удобств, обычно расположена в сельской местности'],
            ['Мотель', 'Придорожный отель с доступом к парковке и минимальным количеством удобств'],
            ['Отель','Объект размещения для путешественников, зачастую располагающий ресторанами, конференц-центрами и другими удобствами'],
            ['Парк-отель','Отдельные дома с собственной кухней, расположенные на одной территории. Есть общие удобства или услуги: развлечения, спорт и т.д.'],
            ['Фермерский дом', 'Частная ферма с простым набором удобств'],
            ['Хостел', 'Бюджетный вариант проживания со спальными местами в общем номере и неформальной обстановкой'],
            ['Шале', 'Отдельно стоящий дом с характерной скатной крышей, сдается для проведения отпуска'],
        ];

        //not use
        /*
        $type = [
            ['Апарт-отель', 'Квартира с собственной кухней и некоторыми удобствами отеля, например, со стойкой регистрации'],
            ['Ботель', 'Отель на воде, коммерческое судно, сдаваемое в аренду путешественникам'],
            ['Кемпинг', 'Размещение в небольших домиках или бунгало рядом с зоной для кемпинга или стоянкой для домов на колесах.
                Есть общие удобства или услуги: развлечения, спорт и т.д.'],
            ['Люкс-шатер', 'Шатры с фиксированными спальными местами и некоторыми удобствами, расположенные на природе'],
            ['Отель типа «постель и завтрак»', 'Частный дом со спальными местами в аренду и завтраком для гостей'],
            ['Отель для свиданий', 'Объект размещения только для взрослых с почасовой или посуточной арендой'],
            ['Проживание в семье','Дом, где у гостя отдельная комната, но хозяин проживает на территории. Некоторые удобства общие для хозяина и гостей.'],
            ['Риад', 'Традиционный марокканский дом или дворец с внутренним двором'],
            ['Рёкан', 'Гостиница в традиционном японском стиле с различными вариантами питания'],
        ];
        */

        Yii::$app->db->createCommand()->batchInsert('type_hotel', ['name', 'description'], $types)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        Yii::$app->db->createCommand()->delete('type_hotel')->query();
    }

}
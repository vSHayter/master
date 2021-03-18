<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "index_hotel_service".
 *
 * @property int $id
 * @property int|null $id_hotel
 * @property int|null $id_service
 * @property int|null $payment
 *
 * @property Hotel $hotel
 * @property ServiceHotel $service
 */
class IndexHotelService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'index_hotel_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_hotel', 'id_service', 'payment'], 'integer'],
            [['id_hotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['id_hotel' => 'id']],
            [['id_service'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceHotel::className(), 'targetAttribute' => ['id_service' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_hotel' => 'Id Hotel',
            'id_service' => 'Id Service',
            'payment' => 'Payment',
        ];
    }

    /**
     * Gets query for [[Hotel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'id_hotel']);
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(ServiceHotel::className(), ['id' => 'id_service']);
    }
}

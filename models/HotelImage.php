<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_image".
 *
 * @property int $id
 * @property int|null $id_hotel
 * @property string|null $image
 *
 * @property Hotel $hotel
 */
class HotelImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_hotel'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['id_hotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::class, 'targetAttribute' => ['id_hotel' => 'id']],
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
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Hotel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::class, ['id' => 'id_hotel']);
    }
}

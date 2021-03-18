<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room".
 *
 * @property int $id
 * @property int|null $amount_people
 * @property float|null $cost
 * @property int|null $area
 * @property int|null $amount_room
 * @property string|null $description
 * @property int|null $id_type
 * @property int|null $id_hotel
 *
 * @property Booking[] $bookings
 * @property IndexRoomService[] $indexRoomServices
 * @property Hotel $hotel
 * @property TypeRoom $type
 * @property RoomImage[] $roomImages
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['amount_people', 'area', 'amount_room', 'id_type', 'id_hotel'], 'integer'],
            [['cost'], 'number'],
            [['description'], 'string'],
            [['id_hotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['id_hotel' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => TypeRoom::className(), 'targetAttribute' => ['id_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount_people' => 'Amount People',
            'cost' => 'Cost',
            'area' => 'Area',
            'amount_room' => 'Amount Room',
            'description' => 'Description',
            'id_type' => 'Id Type',
            'id_hotel' => 'Id Hotel',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['id_room' => 'id']);
    }

    /**
     * Gets query for [[IndexRoomServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndexRoomServices()
    {
        return $this->hasMany(IndexRoomService::className(), ['id_room' => 'id']);
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
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeRoom::className(), ['id' => 'id_type']);
    }

    /**
     * Gets query for [[RoomImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoomImages()
    {
        return $this->hasMany(RoomImage::className(), ['id_room' => 'id']);
    }
}

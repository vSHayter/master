<?php

namespace app\models;

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
            [['id_hotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::class, 'targetAttribute' => ['id_hotel' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => TypeRoom::class, 'targetAttribute' => ['id_type' => 'id']],
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
            'available_room' => 'Available Room',
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
        return $this->hasMany(Booking::class, ['id_room' => 'id']);
    }

    /**
     * Gets query for [[IndexRoomServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndexRoomServices()
    {
        return $this->hasMany(IndexRoomService::class, ['id_room' => 'id']);
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

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeRoom::class, ['id' => 'id_type']);
    }

    /**
     * Gets query for [[RoomImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoomImages()
    {
        return $this->hasMany(RoomImage::class, ['id_room' => 'id']);
    }

    /**
     * Check room availability.
     *
     * @param $idRoom
     * @param $dateStart
     * @param $dateEnd
     * @return false|mixed
     */
    public function checkRoomAvailability($idRoom, $dateStart, $dateEnd)
    {
        $values = [
            'id_room' => $idRoom,
            'date_start' => $dateStart,
            'date_end' => $dateEnd
        ];

        $query = Room::find()
            //->select(['room.*', 'booking.date_start', 'booking.date_end', 'amount_room - COUNT(room.id) OVER (PARTITION BY room.id) as available_room'])
            ->select(['room.*', 'booking.date_start', 'booking.date_end', 'room.amount_room - SUM(booking.amount_room) as available_room'])
            ->joinWith('bookings')
            ->where(['room.id' => $values['id_room']])
            ->andWhere(['<', 'booking.date_start', $values['date_end']])
            ->andWhere(['>', 'booking.date_end', $values['date_start']])
            ->asArray()
            ->all();

        if(isset($query[0]['available_room'])) {
            if($query[0]['available_room'] > 0) {
                return $query[0]['available_room'];
            } else {
                return false;
            }
        } else {
            $amount = Room::find()->where(['id' => $idRoom])->one();
            return $amount['amount_room'];
        }

    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $phone_number
 * @property string|null $house_number
 * @property string|null $address
 * @property int|null $index
 * @property int|null $status
 * @property int|null $id_type
 * @property int|null $id_city
 *
 * @property Favourite[] $favourites
 * @property Feedback[] $feedbacks
 * @property City $city
 * @property TypeHotel $type
 * @property HotelImage[] $hotelImages
 * @property HotelParameter[] $hotelParameters
 * @property IndexHotelService[] $indexHotelServices
 * @property Like[] $likes
 * @property Room[] $rooms
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['index', 'status', 'id_type', 'id_city'], 'integer'],
            [['name', 'phone_number', 'house_number', 'address'], 'string', 'max' => 255],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['id_city' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => TypeHotel::className(), 'targetAttribute' => ['id_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'phone_number' => 'Phone Number',
            'house_number' => 'House Number',
            'address' => 'Address',
            'index' => 'Index',
            'status' => 'Status',
            'id_type' => 'Id Type',
            'id_city' => 'Id City',
        ];
    }

    /**
     * Gets query for [[Favourites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavourites()
    {
        return $this->hasMany(Favourite::className(), ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_city']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeHotel::className(), ['id' => 'id_type']);
    }

    /**
     * Gets query for [[HotelImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelImages()
    {
        return $this->hasMany(HotelImage::className(), ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[HotelParameters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelParameters()
    {
        return $this->hasMany(HotelParameter::className(), ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[IndexHotelServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndexHotelServices()
    {
        return $this->hasMany(IndexHotelService::className(), ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::className(), ['id_hotel' => 'id']);
    }
}

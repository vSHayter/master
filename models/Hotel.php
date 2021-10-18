<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $stars
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
 * @property IndexHotelService[] $indexHotelServices
 * @property Rating[] $ratings
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
            [['stars', 'index', 'status', 'id_type', 'id_city'], 'integer'],
            [['name', 'address'], 'string', 'max' => 255],
            [['phone_number'], 'string', 'max' => 20],
            [['house_number'], 'string', 'max' => 10],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => City::class, 'targetAttribute' => ['id_city' => 'id']],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => TypeHotel::class, 'targetAttribute' => ['id_type' => 'id']],
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
            'stars' => 'Stars',
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
        return $this->hasMany(Favourite::class, ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::class, ['id' => 'id_city']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeHotel::class, ['id' => 'id_type']);
    }

    /**
     * Gets query for [[HotelImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelImages()
    {
        return $this->hasMany(HotelImage::class, ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[IndexHotelServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndexHotelServices()
    {
        return $this->hasMany(IndexHotelService::class, ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::class, ['id_hotel' => 'id']);
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Room::class, ['id_hotel' => 'id']);
    }

    public function getMinCostRoom($idHotel)
    {
        $query = Room::find()
            ->where(['id_hotel' => $idHotel])
            ->orderBy('cost')
            ->limit(1)
            ->one();

        return $query->cost;
    }

    /**
     * Get avg user ratings for hotel.
     *
     * @param $idHotel
     * @return float
     */
    public function getUserRating($idHotel)
    {
        $query = Feedback::find()->select(['AVG(rating) as rating'])->where(['id_hotel' => $idHotel])->one();

        return round($query->rating, 2);
    }
}

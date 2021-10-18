<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string|null $feedback
 * @property float|null $rating
 * @property string|null $date
 * @property int|null $id_booking
 * @property int|null $id_hotel
 *
 * @property Booking $booking
 * @property Hotel $hotel
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['feedback'], 'string'],
            [['rating'], 'number'],
            [['date'], 'safe'],
            [['id_booking', 'id_hotel'], 'integer'],
            [['id_booking'], 'exist', 'skipOnError' => true, 'targetClass' => Booking::class, 'targetAttribute' => ['id_booking' => 'id']],
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
            'feedback' => 'Feedback',
            'rating' => 'Rating',
            'date' => 'Date',
            'id_booking' => 'Id Booking',
            'id_hotel' => 'Id Hotel',
        ];
    }

    /**
     * Gets query for [[Booking]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBooking()
    {
        return $this->hasOne(Booking::class, ['id' => 'id_booking']);
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

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string|null $date_booking
 * @property string|null $date_start
 * @property string|null $date_end
 * @property string|null $wishes
 * @property int|null $amount_room
 * @property int|null $amount_people
 * @property int|null $total
 * @property int|null $status
 * @property int|null $id_user
 * @property int|null $id_room
 *
 * @property Room $room
 * @property User $user
 * @property Feedback[] $feedbacks
 * @property Payment[] $payments
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_booking', 'date_start', 'date_end'], 'safe'],
            [['wishes'], 'string'],
            [['amount_room', 'amount_people', 'total', 'status', 'id_user', 'id_room'], 'integer'],
            [['id_room'], 'exist', 'skipOnError' => true, 'targetClass' => Room::class, 'targetAttribute' => ['id_room' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_booking' => 'Date Booking',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'wishes' => 'Wishes',
            'amount_room' => 'Amount Room',
            'amount_people' => 'Amount People',
            'total' => 'Total',
            'status' => 'Status',
            'id_user' => 'Id User',
            'id_room' => 'Id Room',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::class, ['id' => 'id_room']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }

    /**
     * Gets query for [[Feedbacks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::class, ['id_booking' => 'id']);
    }

    /**
     * Gets query for [[Payments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::class, ['id_booking' => 'id']);
    }
}

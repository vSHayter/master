<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rating".
 *
 * @property int|null $id_user
 * @property int|null $id_hotel
 * @property float|null $rating
 * @property string|null $timestamp
 *
 * @property Hotel $hotel
 * @property User $user
 */
class Rating extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rating';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_hotel'], 'integer'],
            [['rating'], 'number'],
            [['timestamp'], 'string', 'max' => 255],
            [['id_hotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::class, 'targetAttribute' => ['id_hotel' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'id_hotel' => 'Id Hotel',
            'rating' => 'Rating',
            'timestamp' => 'Timestamp',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'id_user']);
    }
}

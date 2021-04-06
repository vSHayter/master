<?php

namespace app\models;

use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $name
 * @property string|null $surname
 * @property string|null $patronymic
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $password_hash
 * @property int|null $status
 *
 * @property Booking[] $bookings
 * @property Favourite[] $favourites
 * @property Like[] $likes
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['username', 'name', 'surname', 'patronymic', 'phone', 'email', 'password_hash'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'phone' => 'Phone',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Bookings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Favourites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavourites()
    {
        return $this->hasMany(Favourite::className(), ['id_user' => 'id']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Like::className(), ['id_user' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        //return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        //return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username) {
        return User::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password_hash === sha1($password);
    }

    public function setPassword($password) {
        $this->password_hash = sha1($password);
    }

    public function create()
    {
        return $this->save(false);
    }

    public function checkLikeHotelByUser($hotel)
    {
        $query = Like::find()->where(['id_user' => $this->id])
            ->andWhere(['id_hotel' => $hotel])
            ->one();

        if ($query != null)
            return true;
        else
            return false;
    }
}

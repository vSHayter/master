<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_hotel".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property IndexHotelService[] $indexHotelServices
 */
class ServiceHotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * Gets query for [[IndexHotelServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndexHotelServices()
    {
        return $this->hasMany(IndexHotelService::className(), ['id_service' => 'id']);
    }
}

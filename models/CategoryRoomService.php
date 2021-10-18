<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_room_service".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property ServiceRoom[] $serviceRooms
 */
class CategoryRoomService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_room_service';
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
     * Gets query for [[ServiceRooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceRooms()
    {
        return $this->hasMany(ServiceRoom::class, ['id_category' => 'id']);
    }
}

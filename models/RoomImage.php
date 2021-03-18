<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "room_image".
 *
 * @property int $id
 * @property int|null $id_room
 * @property string|null $image
 *
 * @property Room $room
 */
class RoomImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_room'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['id_room'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['id_room' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_room' => 'Id Room',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Room]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'id_room']);
    }
}

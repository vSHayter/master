<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "index_room_service".
 *
 * @property int $id
 * @property int|null $id_room
 * @property int|null $id_service
 *
 * @property Room $room
 * @property ServiceRoom $service
 */
class IndexRoomService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'index_room_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_room', 'id_service'], 'integer'],
            [['id_room'], 'exist', 'skipOnError' => true, 'targetClass' => Room::className(), 'targetAttribute' => ['id_room' => 'id']],
            [['id_service'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceRoom::className(), 'targetAttribute' => ['id_service' => 'id']],
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
            'id_service' => 'Id Service',
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

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(ServiceRoom::className(), ['id' => 'id_service']);
    }
}

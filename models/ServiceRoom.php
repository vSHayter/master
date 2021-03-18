<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_room".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $id_category
 *
 * @property IndexRoomService[] $indexRoomServices
 * @property CategoryRoomService $category
 */
class ServiceRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_category'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_category'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryRoomService::className(), 'targetAttribute' => ['id_category' => 'id']],
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
            'id_category' => 'Id Category',
        ];
    }

    /**
     * Gets query for [[IndexRoomServices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIndexRoomServices()
    {
        return $this->hasMany(IndexRoomService::className(), ['id_service' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryRoomService::className(), ['id' => 'id_category']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category_type_room".
 *
 * @property int $id
 * @property string|null $name
 *
 * @property TypeRoom[] $typeRooms
 */
class CategoryTypeRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category_type_room';
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
     * Gets query for [[TypeRooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTypeRooms()
    {
        return $this->hasMany(TypeRoom::className(), ['id_category' => 'id']);
    }
}

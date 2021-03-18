<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_hotel".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 *
 * @property Hotel[] $hotels
 * @property ParameterType[] $parameterTypes
 */
class TypeHotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
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
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Hotels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotels()
    {
        return $this->hasMany(Hotel::className(), ['id_type' => 'id']);
    }

    /**
     * Gets query for [[ParameterTypes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParameterTypes()
    {
        return $this->hasMany(ParameterType::className(), ['id_type' => 'id']);
    }
}

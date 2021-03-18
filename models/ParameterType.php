<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parameter_type".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $id_type
 *
 * @property HotelParameter[] $hotelParameters
 * @property TypeHotel $type
 */
class ParameterType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'parameter_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_type'], 'exist', 'skipOnError' => true, 'targetClass' => TypeHotel::className(), 'targetAttribute' => ['id_type' => 'id']],
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
            'id_type' => 'Id Type',
        ];
    }

    /**
     * Gets query for [[HotelParameters]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotelParameters()
    {
        return $this->hasMany(HotelParameter::className(), ['id_parameter' => 'id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeHotel::className(), ['id' => 'id_type']);
    }
}

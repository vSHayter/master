<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "hotel_parameter".
 *
 * @property int $id
 * @property int|null $id_hotel
 * @property int|null $id_parameter
 * @property string|null $value
 *
 * @property Hotel $hotel
 * @property ParameterType $parameter
 */
class HotelParameter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_parameter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_hotel', 'id_parameter'], 'integer'],
            [['value'], 'string', 'max' => 255],
            [['id_hotel'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['id_hotel' => 'id']],
            [['id_parameter'], 'exist', 'skipOnError' => true, 'targetClass' => ParameterType::className(), 'targetAttribute' => ['id_parameter' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_hotel' => 'Id Hotel',
            'id_parameter' => 'Id Parameter',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Hotel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'id_hotel']);
    }

    /**
     * Gets query for [[Parameter]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParameter()
    {
        return $this->hasOne(ParameterType::className(), ['id' => 'id_parameter']);
    }
}

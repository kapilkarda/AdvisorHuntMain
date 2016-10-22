<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "zipcode".
 *
 * @property integer $id
 * @property integer $zip
 * @property double $latitude
 * @property double $longitude
 * @property string $timezone
 * @property integer $dst
 * @property integer $city_id
 *
 * @property City $city
 */
class Zipcode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'zipcode';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zip', 'latitude', 'longitude', 'timezone', 'dst', 'city_id'], 'required'],
            [['zip', 'dst', 'city_id'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['timezone'], 'string', 'max' => 10],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zip' => 'Zip',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'timezone' => 'Timezone',
            'dst' => 'Dst',
            'city_id' => 'City ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}

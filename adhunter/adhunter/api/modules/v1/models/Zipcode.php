<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

use Yii;


class Zipcode extends ActiveRecord
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

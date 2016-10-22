<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

use Yii;
//use webvimark\modules\UserManagement\models\User;

class UserDetails extends ActiveRecord
{
    public $zip;
    public $profile_pic1;
    public $city;
    public $User;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'mobile', 'address','zip'], 'required'],
            [['phone', 'mobile', 'city_id', 'state_id', 'country_id', 'user_id'], 'integer'],
            [['first_name', 'last_name', 'address', 'address1'], 'string', 'max' => 200],
            [['profile_pic', 'email', 'dynamic1', 'dynamic2'], 'string', 'max' => 100],
            // [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
            //[['zip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['zip'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip' => 'zip']],
             [['city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'profile_pic1' => 'Profile Pic',
            'email' => 'Email',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'address1' => 'Address1',
            'city_id' => 'City ID',
            'state_id' => 'State ID',
            'zip_id' => 'Zip ID',
            'country_id' => 'Country ID',
            'user_id' => 'User ID',
            'dynamic1' => 'Dynamic1',
            'dynamic2' => 'Dynamic2',
            'zip' => 'Zip',
            
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState()
    {
        return $this->hasOne(State::className(), ['id' => 'state_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZip()
    {
        return $this->hasOne(Zipcode::className(), ['id' => 'zip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

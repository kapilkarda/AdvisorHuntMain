<?php

namespace backend\models;

use Yii;
use webvimark\modules\UserManagement\models\User;
/**
 * This is the model class for table "user_details".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $profile_pic
 * @property string $email
 * @property integer $phone
 * @property integer $mobile
 * @property string $address
 * @property string $address1
 * @property integer $city_id
 * @property integer $state_id
 * @property integer $zip_id
 * @property integer $country_id
 * @property integer $user_id
 * @property string $dynamic 1
 * @property string $dynamic 2
 *
 * @property City $city
 * @property State $state
 * @property Zipcode $zip
 * @property Country $country
 * @property User $user
 */
class UserDetails extends \yii\db\ActiveRecord
{        // public $profile_pici;
       public $imagei;
      public $zip;
      public $city;
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
            [[ 'mobile', 'address','zip', 'city_id','state_id', 'country_id','user_id'], 'required'],
            [['zip','state_id', 'country_id', 'user_id'], 'integer'],
            // [['phone', 'mobile'], 'integer', 'max' => 10, 'min' => 10],
            [['mobile'], 'match','pattern'=> '/^[0-9]{10}$/','message'=> 'Invalid Mobile number.'],
            [['phone'], 'match','pattern'=> '/^[0-9]{10}$/','message'=> 'Invalid Phone number.'],
            [['first_name', 'last_name', 'address', 'address1'], 'string', 'max' => 200],
            [['profile_pic', 'email', 'dynamic1', 'dynamic2'], 'string', 'max' => 100],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
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
            'imagei' => 'Profile Pic',
            'email' => 'Email',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'address' => 'Address',
            'address1' => 'Address1',
            'city_id' => 'City',
            'state_id' => 'State',
            'zip_id' => 'Zip',
            'country_id' => 'Country',
            'user_id' => 'User',
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

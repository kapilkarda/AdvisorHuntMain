<?php

namespace backend\models;

use Yii;
use webvimark\modules\UserManagement\models\User;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $address1
 * @property integer $city_id
 * @property integer $state_id
 * @property integer $country_id
 * @property integer $zip_id
 * @property string $about
 * @property string $year_founded
 * @property string $website
 * @property string $profile_pic
 * @property string $banner
 * @property string $phone
 * @property string $mobile
 * @property integer $mobile_alert_flag
 * @property string $email
 * @property integer $notification_to_email
 * @property integer $user_id
 * @property integer $active_company_flag
 * @property string $company_claimed
 * @property string $invoice_logo
 */
class Company extends \yii\db\ActiveRecord
{
     public $city;
     public $image;
     public $ibanner;
     public $invoice_logoi;
      public $zip;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'mobile', 'email', 'zip', 'city_id', 'state_id', 'country_id','user_id'], 'required'],
            [['state_id', 'country_id','year_founded', 'mobile_alert_flag', 'closed_company_flag', 'user_id', 'active_company_flag'], 'integer'],
            [['mobile'], 'match','pattern'=> '/^[0-9]{10}$/','message'=> 'Invalid Mobile number.'],
             [['phone'], 'match','pattern'=> '/^[0-9]{10}$/','message'=> 'Invalid Phone number.'],
             // [['phone', 'mobile'], 'integer', 'max' => 10, 'min' => 10],
            [['about'], 'string'],
            [['year_founded'], 'safe'],
            [['year_founded'], 'match','pattern'=> '/^[0-9]{4}$/','message'=> 'Invalid Year.'],
            [['name', 'company_claimed'], 'string', 'max' => 200],
            [['address', 'address1'], 'string', 'max' => 500],
            [['banner', 'invoice_logo'], 'image'],
            ['website', 'url', 'defaultScheme' => 'http'],
             [['profile_pic', 'banner', 'invoice_logo'], 'file','skipOnEmpty' => true,'extensions'=>['jpg,jpeg,gif,png']],
           
            [['email'], 'email'],
            [['website', 'profile_pic', 'banner', 'email', 'invoice_logo'], 'string', 'max' => 100],
            //[['zip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            // [['city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city' => 'name']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
             //[['profile_pic'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
            [['zip'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip' => 'zip']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Company Name',
            'address' => 'Address',
            'address1' => 'Address1',
            'city_id' => 'City',
            'state_id' => 'State',
            'country_id' => 'Country',
            'zip_id' => 'Zip',
            'about' => 'About',
            'year_founded' => 'Year Founded',
            'website' => 'Website',
            //'profile_pic' => 'Profile Pic',
            'ibanner' => 'Banner',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'mobile_alert_flag' => 'Mobile Alert Flag',
            'email' => 'Email',
            //'notification_to_email' => 'Notification To Email',
            'user_id' => 'User',
            'active_company_flag' => 'Active Company Flag',
            'company_claimed' => 'Company Claimed',
            'invoice_logoi' => 'Invoice Logo',
            'city' => 'City',
            'image' => 'Image',
            'zip' => 'Zip',
            'closed_company_flag'=>'Closed Company Flag',
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
    public function getSubcategory() {
        return $this->hasMany(Subcategory::className(), ['id' => 'fk_i_service_id'])
          ->viaTable('company_serivces', ['fk_i_company_id' => 'id']);
    }

    public function getServicearea() {
        return $this->hasMany(Zipcode::className(), ['id' => 'fk_i_service_area_zip'])
          ->viaTable('company_service_area', ['fk_i_company_id' => 'id']);
    }
    //  public function getZipcode(){
    //    $model1=CompanyLicense::find()->all();
    //    foreach($model1 as $value)
    //  {
    //   echo $value['fk_i_state_id']."<br>";
    //    
    //  }
    //}
    //

     // Fetch sub categroy of a company
    public function getCategorysOfCompany($id){
        $company = $this::find()->with('subcategory')->where(['id' => $id])->one();
        $category = '';
        $tmpCompanyArray=array_keys($company->subcategory);
        $last_key = end($tmpCompanyArray);
        foreach ($company->subcategory as $key => $value) {
             if ($key == $last_key) {
                $category .= $value['name'];
            } else {
                $category .= $value['name'].", ";
            }
        }
        return $category;
    }

}
<?php

namespace backend\models;
use webvimark\modules\UserManagement\models\User;
use backend\models\City;
use Yii;

/**
 * This is the model class for table "lead".
 *
 * @property integer $pk_i_id
 * @property string $s_name
 * @property integer $fk_i_sub_category_id
 * @property string $s_address
 * @property string $s_address1
 * @property integer $fk_i_city_id
 * @property integer $fk_i_state_id
 * @property integer $fk_i_country_id
 * @property integer $fk_i_zip_id
 * @property string $s_email
 * @property string $s_mobile
 * @property string $s_ip_address
 * @property integer $i_status
 * @property integer $fk_i_requested_by
 * @property string $dt_date_created
 * @property string $dt_request_complete_date
 * @property integer $i_request_renewed_count
 * @property string $dt_request_renew_date
 */
class Lead extends \yii\db\ActiveRecord
{
    public $city;
     public $zip;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lead';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name', 'fk_i_sub_category_id', 's_address', 's_email', 's_mobile', 'fk_i_state_id', 'fk_i_country_id','fk_i_requested_by','zip'], 'required'],
            [['fk_i_sub_category_id', 'fk_i_state_id', 'fk_i_country_id', 'i_status', 'fk_i_requested_by', 'i_request_renewed_count','zip'], 'integer'],
            [['dt_date_created', 'dt_request_complete_date', 'dt_request_renew_date'], 'safe'],
            [['s_name'], 'string', 'max' => 50],
            [['s_address', 's_address1'], 'string', 'max' => 255],
            [['s_email'], 'string', 'max' => 100],
            [['s_email'], 'email'],
            [['mobile'], 'match','pattern'=> '/^[0-9]{10}$/','message'=> 'Invalid Mobile number.'],
            [['s_ip_address'], 'ip'],
            [['fk_i_sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['fk_i_sub_category_id' => 'id']],
            //[['fk_i_zip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['fk_i_zip_id' => 'id']],
            [['fk_i_requested_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_i_requested_by' => 'id']],
            // [['fk_i_city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['fk_i_city_id' => 'id']],
            [['fk_i_state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['fk_i_state_id' => 'id']],
            [['fk_i_country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['fk_i_country_id' => 'id']],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city' => 'name']],
            [['zip'], 'exist', 'skipOnError' => false, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip' => 'zip']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            's_name' => 'Title',
            'fk_i_sub_category_id' => 'Sub Category',
            's_address' => 'Address',
            's_address1' => 'Address1',
            'fk_i_city_id' => 'City',
            'fk_i_state_id' => 'State',
            'fk_i_country_id' => 'Country',
            'fk_i_zip_id' => 'Zip',
            's_email' => 'Email',
            's_mobile' => 'Mobile',
            's_ip_address' => 'Ip Address',
            'i_status' => 'Status',
            'fk_i_requested_by' => 'Requested By',
            'dt_date_created' => 'Date Created',
            'dt_request_complete_date' => 'Request Complete Date',
            'i_request_renewed_count' => 'Request Renewed Count',
            'dt_request_renew_date' => 'Request Renew Date',
            'city' => 'City',
            'zip' => 'Zip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
    */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'fk_i_city_id']);
    }
}

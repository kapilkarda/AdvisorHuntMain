<?php

namespace backend\models;
use Yii;

/**
 * This is the model class for table "token".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_sub_category_id
 * @property integer $fk_i_zip_id
 * @property integer $i_project_cost_range_from
 * @property integer $i_project_cost_range_to
 * @property integer $i_token_count
 */
class Token extends \yii\db\ActiveRecord
{      public $city;
     public $zip;
   // public $state;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_sub_category_id', 'i_project_cost_range_from', 'i_project_cost_range_to', 'i_token_count', 'zip'], 'required'],
            [['fk_i_sub_category_id', 'i_project_cost_range_from', 'i_project_cost_range_to', 'i_token_count', 'zip'], 'integer'],
            [['fk_i_sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['fk_i_sub_category_id' => 'id']],
            // [['fk_i_zip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['fk_i_zip_id' => 'zip']],
            [['city'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city' => 'name']],
           // [['state'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city' => 'name']],
            [['zip'], 'exist','skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip' => 'zip']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_sub_category_id' => 'Sub Category',
            'fk_i_zip_id' => 'Zip',
            'i_project_cost_range_from' => 'Project Cost Range From',
            'i_project_cost_range_to' => 'Project Cost Range To',
            'i_token_count' => 'Token Count',
            'zip' => 'Zip',
            'state_id' => 'State',
            'city_id' => 'City',
            'city' => 'City',
          //  'state' => 'State',
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
    public function getZipcode()
    {
        return $this->hasOne(Zipcode::className(), ['id' => 'fk_i_zip_id']);
    }
}

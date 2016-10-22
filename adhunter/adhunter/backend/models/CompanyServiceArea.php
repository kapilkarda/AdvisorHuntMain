<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_service_area".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_company_id
 * @property integer $fk_i_service_area_zip
 *
 * @property Company $fkICompany
 * @property Zipcode $fkIServiceAreaZip
 */
class CompanyServiceArea extends \yii\db\ActiveRecord
{
    public $zip;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_service_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_company_id', 'zip'], 'required'],
            [['fk_i_company_id', 'zip'], 'integer'],
            [['dt_created_at'], 'safe'],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
            [['zip'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip' => 'zip']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_company_id' => 'Company ',
            'fk_i_service_area_zip' => 'Service Area Zip',
            'zip' => 'Service Area Zip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkICompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_i_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIServiceAreaZip()
    {
        return $this->hasOne(Zipcode::className(), ['id' => 'fk_i_service_area_zip']);
    }
}

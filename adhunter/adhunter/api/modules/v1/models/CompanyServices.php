<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
//namespace backend\models;
//use Yii;

class CompanyServices extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_serivces';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_company_id', 'fk_i_service_id'], 'required'],
            [['fk_i_company_id', 'fk_i_service_id'], 'integer'],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
            [['fk_i_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['fk_i_service_id' => 'id']],
        ];
    }

    ///**
    // * @inheritdoc
    // */
    //public function attributeLabels()
    //{
    //    return [
    //        'pk_i_id' => 'Pk I ID',
    //        'fk_i_company_id' => 'Fk I Company ID',
    //        'fk_i_service_id' => 'Fk I Service ID',
    //    ];
    //}
    //
    ///**
    // * @return \yii\db\ActiveQuery
    // */
    //public function getCompany()
    //{
    //    return $this->hasOne(Company::className(), ['id' => 'fk_i_company_id']);
    //}
    //
    ///**
    // * @return \yii\db\ActiveQuery
    // */
    //public function getService()
    //{
    //    return $this->hasOne(Subcategory::className(), ['id' => 'fk_i_service_id']);
    //}
}

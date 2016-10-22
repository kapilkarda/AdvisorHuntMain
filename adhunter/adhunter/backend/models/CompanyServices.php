<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_serivces".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_company_id
 * @property integer $fk_i_service_id
 *
 * @property Company $fkICompany
 * @property Subcategory $fkIService
 */
class CompanyServices extends \yii\db\ActiveRecord
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
            [['dt_created_at'], 'safe'],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
            [['fk_i_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['fk_i_service_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_company_id' => 'Fk I Company ID',
            'fk_i_service_id' => 'Fk I Service ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_i_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'fk_i_service_id']);
    }
}

<?php

namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
use Yii;


class CompanyProject extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pk_i_id', 'fk_i_pro_id', 'b_project_int_ext_type', 's_project_name', 's_project_description', 'i_sub_category_id', 'i_project_year', 'i_project_cost', 'i_project_zip', 's_keywords', 'dt_deleted_at'], 'required'],
            [['pk_i_id', 'fk_i_pro_id', 'b_project_int_ext_type', 'i_sub_category_id', 'i_project_year', 'i_project_cost', 'i_project_zip'], 'integer'],
            [['dt_created_at', 'dt_deleted_at'], 'safe'],
            [['s_project_name', 's_keywords'], 'string', 'max' => 200],
            [['s_project_description'], 'string', 'max' => 500],
            [['fk_i_pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_pro_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_pro_id' => 'Fk I Pro ID',
            'b_project_int_ext_type' => 'B Project Int Ext Type',
            's_project_name' => 'S Project Name',
            's_project_description' => 'S Project Description',
            'i_sub_category_id' => 'I Sub Category ID',
            'i_project_year' => 'I Project Year',
            'i_project_cost' => 'I Project Cost',
            'i_project_zip' => 'I Project Zip',
            's_keywords' => 'S Keywords',
            'dt_created_at' => 'Dt Created At',
            'dt_deleted_at' => 'Dt Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIPro()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_i_pro_id']);
    }
}

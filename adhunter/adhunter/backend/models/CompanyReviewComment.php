<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%company_review_comment}}".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_company_id
 * @property string $s_review_by
 * @property string $s_review_comment
 * @property string $dt_review_date
 *
 * @property Company $fkICompany
 * @property Company $fkICompany0
 */
class CompanyReviewComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%company_review_comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_company_id', 's_review_by', 's_review_comment','fk_i_project_id'], 'required'],
            [['fk_i_company_id','fk_i_project_id','i_status'], 'integer'],
            [['dt_review_date'], 'safe'],
            [['s_review_by'], 'string', 'max' => 100],
            [['s_review_comment'], 'string', 'max' => 255],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
            [['fk_i_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['fk_i_project_id' => 'pk_i_id']],
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
            's_review_by' => 'Review By',
            's_review_comment' => 'Review Comment',
            'dt_review_date' => 'Review Date',
            'fk_i_project_id' =>'Project',
            'i_status' =>'Status',
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
    public function getFkICompany0()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_i_company_id']);
    }

    /**
     * @inheritdoc
     * @return CompanyReviewCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyReviewCommentQuery(get_called_class());
    }
}

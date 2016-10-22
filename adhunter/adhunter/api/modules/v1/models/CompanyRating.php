<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;


class CompanyRating extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_rating';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_company_id', 'fk_i_comment_id', 's_rating_category', 'i_rating', 's_review_by'], 'required'],
            [['fk_i_company_id', 'i_rating', 'fk_i_comment_id'], 'integer'],
            [['dt_review_date'], 'safe'],
            [['s_rating_category'], 'string', 'max' => 50],
            [['s_review_by'], 'string', 'max' => 100],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
            // [['fk_i_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['fk_i_project_id' => 'pk_i_id']],
            [['fk_i_comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyReviewComment::className(), 'targetAttribute' => ['fk_i_comment_id' => 'pk_i_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_company_id' => 'Company',
            's_rating_category' => 'Rating Category',
            'i_rating' => 'Rating',
            's_review_by' => 'Review By',
            'dt_review_date' => 'Review Date',
            'fk_i_comment_id' => 'Comment',
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
    public function getFkIProject()
    {
        return $this->hasOne(Project::className(), ['pk_i_id' => 'fk_i_company_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkICompanyReviewComment()
    {
        return $this->hasOne(CompanyReviewComment::className(), ['pk_i_id' => 'fk_i_company_id']);
    }

    /**
     * @inheritdoc
     * @return CompanyRatingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyRatingQuery(get_called_class());
    }
}

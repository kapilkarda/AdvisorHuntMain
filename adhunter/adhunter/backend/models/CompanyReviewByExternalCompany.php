<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_review_by_external_company".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_company_id
 * @property string $s_yelp_rating_url
 * @property string $s_google_rating
 * @property string $s_BBB_ratings
 *
 * @property Company $fkICompany
 */
class CompanyReviewByExternalCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_review_by_external_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_company_id', 's_yelp_rating_url', 's_google_rating', 's_BBB_ratings'], 'required'],
            [['fk_i_company_id'], 'integer'],
            [['s_yelp_rating_url', 's_google_rating', 's_BBB_ratings'], 'string', 'max' => 255],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
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
            's_yelp_rating_url' => 'S Yelp Rating Url',
            's_google_rating' => 'S Google Rating',
            's_BBB_ratings' => 'S  Bbb Ratings',
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
     * @inheritdoc
     * @return CompanyReviewByExternalCompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CompanyReviewByExternalCompanyQuery(get_called_class());
    }
}

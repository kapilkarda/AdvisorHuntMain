<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "token_promo".
 *
 * @property integer $pk_i_id
 * @property integer $kf_i_company_id
 * @property integer $i_no_of_tokens
 * @property string $fk_i_provided_by
 * @property integer $pk_i_promo_id
 * @property string $dt_created_at
 */
class TokenPromo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token_promo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_company_id', 'i_no_of_tokens', 'fk_i_provided_by', 'pk_i_promo_id'], 'required'],
            [['fk_i_company_id', 'i_no_of_tokens', 'pk_i_promo_id'], 'integer'],
            [['dt_created_at'], 'safe'],
           // [['fk_i_provided_by'], 'string', 'max' => 255],
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
            'i_no_of_tokens' => 'No Of Tokens',
            'fk_i_provided_by' => 'Provided By',
            'pk_i_promo_id' => 'Promo',
            'dt_created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return TokenPromoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TokenPromoQuery(get_called_class());
    }
}

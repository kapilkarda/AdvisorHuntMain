<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;


class BilingCode extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'biling_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_billing_code_details', 'dt_billing_code_start_date', 'dt_billing_code_end_date', 'i_token_count_slab1_id', 'i_token_count_slab2_id', 'i_token_count_slab3_id', 's_discounts'], 'required'],
            [['i_token_count_slab1_id', 'i_token_count_slab2_id', 'i_token_count_slab3_id', 'i_default_billing'], 'integer'],
            [['dt_billing_code_start_date', 'dt_billing_code_end_date'], 'safe'],
            [['s_billing_code_details', 's_discounts'], 'string', 'max' => 255],
            [['i_token_count_slab1_id'], 'exist', 'skipOnError' => true, 'targetClass' => TokenCounts::className(), 'targetAttribute' => ['i_token_count_slab1_id' => 'pk_i_id']],
            [['i_token_count_slab2_id'], 'exist', 'skipOnError' => true, 'targetClass' => TokenCounts::className(), 'targetAttribute' => ['i_token_count_slab2_id' => 'pk_i_id']],
            [['i_token_count_slab3_id'], 'exist', 'skipOnError' => true, 'targetClass' => TokenCounts::className(), 'targetAttribute' => ['i_token_count_slab3_id' => 'pk_i_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'ID',
            'i_biling_Code' => 'Biling Code',
            's_billing_code_details' => 'Billing Code Details',
            'dt_billing_code_start_date' => 'Start Date',
            'dt_billing_code_end_date' => 'End Date',
            'i_token_count_slab1_id' => 'Token Count Slab1',
            'i_token_count_slab2_id' => 'Token Count Slab2',
            'i_token_count_slab3_id' => 'Token Count Slab3',
            's_discounts' => 'Discounts',
            'i_default_billing' => 'Default Billing Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITokenCountSlab1()
    {
        return $this->hasOne(TokenCounts::className(), ['pk_i_id' => 'i_token_count_slab1_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITokenCountSlab2()
    {
        return $this->hasOne(TokenCounts::className(), ['pk_i_id' => 'i_token_count_slab2_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getITokenCountSlab3()
    {
        return $this->hasOne(TokenCounts::className(), ['pk_i_id' => 'i_token_count_slab3_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::className(), ['fk_i_billing_code' => 'fk_i_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferrals()
    {
        return $this->hasMany(Referral::className(), ['fk_i_referral_billing_code' => 'fk_i_id']);
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "referral".
 *
 * @property integer $pk_i_id
 * @property string $s_referral_details
 * @property integer $i_referral_status
 * @property integer $fk_i_requested_user_id
 * @property string $s_referral_sent_to_name
 * @property string $s_referral_sent_to_email
 * @property string $s_referral_sent_to_mobile
 * @property string $s_referral_sent_to_message
 * @property string $dt_referral_sent_date
 * @property integer $i_referral_rminder_count
 * @property string $dt_last_reminder_date
 * @property integer $fk_i_referral_billing_code
 *
 * @property User $fkIRequestedUser
 * @property BilingCode $fkIReferralBillingCode
 */
class Referral extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'referral';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_referral_details', 'i_referral_status', 'fk_i_requested_user_id', 's_referral_sent_to_name', 's_referral_sent_to_email', 's_referral_sent_to_mobile', 's_referral_sent_to_message', 'i_referral_rminder_count', 'dt_last_reminder_date', 'fk_i_referral_billing_code'], 'required'],
            [['i_referral_status', 'fk_i_requested_user_id', 'i_referral_rminder_count', 'fk_i_referral_billing_code'], 'integer'],
            [['s_referral_sent_to_email'], 'email'],
            [['dt_referral_sent_date', 'dt_last_reminder_date'], 'safe'],
            [['s_referral_details'], 'string', 'max' => 255],
            [['s_referral_sent_to_name'], 'string', 'max' => 50],
            [['s_referral_sent_to_email'], 'string', 'max' => 75],
            [['s_referral_sent_to_mobile'], 'string', 'max' => 20],
            [['s_referral_sent_to_message'], 'string', 'max' => 500],
           // [['fk_i_requested_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_i_requested_user_id' => 'id']],
            [['fk_i_referral_billing_code'], 'exist', 'skipOnError' => true, 'targetClass' => BilingCode::className(), 'targetAttribute' => ['fk_i_referral_billing_code' => 'pk_i_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'ID',
            's_referral_details' => 'Referral Details',
            'i_referral_status' => 'Referral Status',
            'fk_i_requested_user_id' => 'Requested User ID',
            's_referral_sent_to_name' => 'Name',
            's_referral_sent_to_email' => 'Email',
            's_referral_sent_to_mobile' => 'Mobile',
            's_referral_sent_to_message' => 'Message',
            'dt_referral_sent_date' => 'Date',
            'i_referral_rminder_count' => 'Reminder Count',
            'dt_last_reminder_date' => 'Last Reminder Date',
            'fk_i_referral_billing_code' => 'Referral Billing Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIRequestedUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_i_requested_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIReferralBillingCode()
    {
        return $this->hasOne(BilingCode::className(), ['pk_i_id' => 'fk_i_referral_billing_code']);
    }
}

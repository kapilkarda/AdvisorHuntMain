<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "purchase_order".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_billing_code
 * @property string $dt_purchase_date
 * @property integer $fk_i_user_id
 * @property integer $i_payments_completed
 * @property double $f_purchase_amount
 * @property string $s_tax
 * @property string $s_purchase_ip
 *
 * @property Payment[] $payments
 * @property Company $fkIUser
 * @property BilingCode $fkIBillingCode
 */
class PurchaseOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'purchase_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_billing_code', 'dt_purchase_date', 'fk_i_user_id', 'i_payments_completed', 'f_purchase_amount', 's_purchase_ip'], 'required'],
            [['fk_i_billing_code', 'fk_i_user_id', 'i_payments_completed'], 'integer'],
            [['dt_purchase_date'], 'safe'],
            [['f_purchase_amount'], 'number'],
            [['s_tax'], 'string', 'max' => 10],
            [['s_purchase_ip'], 'string', 'max' => 20],
            [['fk_i_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_user_id' => 'id']],
            [['fk_i_billing_code'], 'exist', 'skipOnError' => true, 'targetClass' => BilingCode::className(), 'targetAttribute' => ['fk_i_billing_code' => 'pk_i_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_billing_code' => 'Fk I Billing Code',
            'dt_purchase_date' => 'Dt Purchase Date',
            'fk_i_user_id' => 'Fk I User ID',
            'i_payments_completed' => 'I Payments Completed',
            'f_purchase_amount' => 'F Purchase Amount',
            's_tax' => 'S Tax',
            's_purchase_ip' => 'S Purchase Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['fk_i_purchase_order_id' => 'pk_i_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIUser()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_i_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIBillingCode()
    {
        return $this->hasOne(BilingCode::className(), ['pk_i_id' => 'fk_i_billing_code']);
    }
}

<?php

namespace backend\models;

use Yii;
use backend\models\PurchaseOrder;

/**
 * This is the model class for table "payment".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_purchase_order_id
 * @property integer $fk_i_invoice_id
 * @property string $s_payment_type
 * @property integer $fk_i_user_id
 * @property double $f_amount
 * @property integer $b_payments_successful
 * @property string $s_payment_ip
 * @property string $dt_created_at
 *
 * @property PurchaseOrder $fkIPurchaseOrder
 * @property Company $fkIUser
 * @property CustomerInvoice $fkIInvoice
 */
class Payment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_purchase_order_id', 'fk_i_invoice_id', 's_payment_type', 'fk_i_user_id', 'f_amount', 'b_payments_successful', 's_payment_ip'], 'required'],
            [['fk_i_purchase_order_id', 'fk_i_invoice_id', 'fk_i_user_id', 'b_payments_successful'], 'integer'],
            [['f_amount'], 'number'],
            [['dt_created_at'], 'safe'],
            [['s_payment_type'], 'string', 'max' => 50],
            [['s_payment_ip'], 'string', 'max' => 20],
            [['fk_i_purchase_order_id'], 'exist', 'skipOnError' => true, 'targetClass' => PurchaseOrder::className(), 'targetAttribute' => ['fk_i_purchase_order_id' => 'pk_i_id']],
            [['fk_i_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_user_id' => 'id']],
            [['fk_i_invoice_id'], 'exist', 'skipOnError' => true, 'targetClass' => CustomerInvoice::className(), 'targetAttribute' => ['fk_i_invoice_id' => 'pk_i_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'ID',
            'fk_i_purchase_order_id' => 'PO ID',
            'fk_i_invoice_id' => 'Invoice ID',
            's_payment_type' => 'Payment Type',
            'fk_i_user_id' => 'Comapny',
            'f_amount' => 'Amount',
            'b_payments_successful' => 'Payments Status',
            's_payment_ip' => 'IP',
            'dt_created_at' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIPurchaseOrder()
    {
        return $this->hasOne(PurchaseOrder::className(), ['pk_i_id' => 'fk_i_purchase_order_id']);
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
    public function getFkIInvoice()
    {
        return $this->hasOne(CustomerInvoice::className(), ['pk_i_id' => 'fk_i_invoice_id']);
    }
}

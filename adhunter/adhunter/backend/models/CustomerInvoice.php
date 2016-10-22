<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_invoice".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_company_id
 * @property integer $fk_i_user_id
 * @property string $s_memo
 * @property string $dt_invoice_date
 * @property integer $i_invoice_tot_amt
 * @property double $f_invoice_paid_amt
 * @property double $f_invoice_due_amt
 * @property string $dt_paid_date
 *
 * @property Company $fkICompany
 * @property User $fkIUser
 * @property CustomerInvoiceDetails[] $customerInvoiceDetails
 * @property Payment[] $payments
 */
class CustomerInvoice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_company_id', 'fk_i_user_id', 's_memo', 'dt_invoice_date', 'i_invoice_tot_amt', 'f_invoice_paid_amt', 'f_invoice_due_amt', 'dt_paid_date'], 'required'],
            [['fk_i_company_id', 'fk_i_user_id', 'i_invoice_tot_amt'], 'integer'],
            [['dt_invoice_date', 'dt_paid_date'], 'safe'],
            [['f_invoice_paid_amt', 'f_invoice_due_amt'], 'number'],
            [['s_memo'], 'string', 'max' => 255],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
           // [['fk_i_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_i_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'ID',
            'fk_i_company_id' => 'Company',
            'fk_i_user_id' => 'User ID',
            's_memo' => 'Memo',
            'dt_invoice_date' => 'Invoice Date',
            'i_invoice_tot_amt' => 'Total',
            'f_invoice_paid_amt' => 'Paid',
            'f_invoice_due_amt' => 'Due',
            'dt_paid_date' => 'Paid On',
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
    public function getFkIUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_i_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerInvoiceDetails()
    {
        return $this->hasMany(CustomerInvoiceDetails::className(), ['fk_i_invoice_id' => 'pk_i_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['fk_i_invoice_id' => 'pk_i_id']);
    }
}

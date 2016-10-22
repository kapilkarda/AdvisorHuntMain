<?php

namespace backend\models;
use backend\models\Company;

use Yii;

/**
 * This is the model class for table "refund".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_project_id
 * @property integer $fk_i_pro_id
 * @property integer $fk_i_bid_id
 * @property string $s_description
 * @property string $dt_date
 * @property string $s_refund_processed_by
 * @property integer $i_refund_status
 *
 * @property User $fkIPro
 * @property Bid $fkIBid
 */
class Refund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refund';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_project_id', 'fk_i_pro_id', 'fk_i_bid_id', 's_description', 'dt_date', 's_refund_processed_by', 'i_refund_status'], 'required'],
            [['fk_i_project_id', 'fk_i_pro_id', 'fk_i_bid_id', 'i_refund_status'], 'integer'],
            [['dt_date'], 'safe'],
            [['s_description'], 'string', 'max' => 255],
            [['s_refund_processed_by'], 'string', 'max' => 50],
            [['fk_i_pro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_pro_id' => 'id']],
            [['fk_i_bid_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bid::className(), 'targetAttribute' => ['fk_i_bid_id' => 'pk_i_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'ID',
            'fk_i_project_id' => 'Lead',
            'fk_i_pro_id' => 'Pro ',
            'fk_i_bid_id' => 'Bid',
            's_description' => 'Description',
            'dt_date' => 'Date',
            's_refund_processed_by' => 'Processed By',
            'i_refund_status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIPro()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_i_pro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIBid()
    {
        return $this->hasOne(Bid::className(), ['pk_i_id' => 'fk_i_bid_id']);
    }
}

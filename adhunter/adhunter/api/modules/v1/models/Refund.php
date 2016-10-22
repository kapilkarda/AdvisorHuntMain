<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
use backend\models\Company;
use Yii;

class Refund extends ActiveRecord
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

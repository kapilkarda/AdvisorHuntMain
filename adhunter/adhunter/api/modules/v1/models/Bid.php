<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;



class Bid extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bid';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_lead_id', 'fk_i_user_id', 's_ip_address', 'fk_i_token_used_id', 'i_status'], 'required'],
            [['fk_i_lead_id', 'fk_i_user_id', 'fk_i_token_used_id', 'i_status'], 'integer'],
            [['s_ip_address'], 'string', 'max' => 255],
            [['fk_i_lead_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::className(), 'targetAttribute' => ['fk_i_lead_id' => 'pk_i_id']],
            [['fk_i_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_lead_id' => 'Lead ID',
            'fk_i_user_id' => 'Company',
            's_ip_address' => 'IP Address',
            'fk_i_token_used_id' => 'Token Used',
            'i_status' => 'Status',
        ];
    }
    
    //  public function getLead()
    //{
    //    return $this->hasMany(EventMedia::className(), ['pk_i_id' => 'fk_i_lead_id']);
    //}
}

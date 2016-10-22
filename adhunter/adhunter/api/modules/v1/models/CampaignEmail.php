<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "campaign_email".
 *
 * @property integer $pk_i_id
 * @property string $s_name
 * @property string $s_query
 * @property string $s_email_body
 * @property string $s_status
 */
class CampaignEmail extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign_email';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name','fk_i_template_id'], 'required'],
            [['s_user_query', 's_company_query', 's_email_body'], 'string'],
            [['s_name', 's_status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            's_name' => 'Name',
            's_user_query' => 'User Query',
            's_company_query' =>'Company Query',
             's_status' => 'Status',
            'fk_i_template_id' => 'Template ID'
        ];
    }
}

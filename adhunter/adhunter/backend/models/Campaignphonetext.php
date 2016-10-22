<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "campaign_phone_text".
 *
 * @property integer $pk_i_id
 * @property string $s_name
 * @property string $s_user_query
 * @property string $s_company_query
 * @property string $s_body
 * @property string $s_status
 * @property integer $fk_i_template_id
 * @property string $dt_deleted_at
 *
 * @property PhoneTextTemplate $fkITemplate
 */
class campaignphonetext extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign_phone_text';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name', 's_body', 's_status', 'fk_i_template_id'], 'required' ],
            [['fk_i_template_id'], 'integer'],
            [['dt_deleted_at'], 'safe'],
            [['s_name', 's_status'], 'string', 'max' => 100],
            [['s_user_query', 's_company_query', 's_body'], 'string', 'max' => 1000],
//             [['fk_i_template_id'], 'unique'],
            [['fk_i_template_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhoneTextTemplate::className(), 'targetAttribute' => ['fk_i_template_id' => 'pk_i_id']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'ID',
            's_name' => 'Name',
            's_user_query' => 'User Query',
            's_company_query' => 'Company Query',
            's_body' => 'Body',
            's_status' => 'Status',
            'fk_i_template_id' => 'Template ID',
            'dt_deleted_at' => 'Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkITemplate()
    {
        return $this->hasOne(PhoneTextTemplate::className(), ['pk_i_id' => 'fk_i_template_id']);
    }
}

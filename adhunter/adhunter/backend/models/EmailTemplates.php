<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "email_templates".
 *
 * @property integer $pk_i_id
 * @property string $s_name
 * @property string $s_title
 * @property string $s_email_template
 *
 * @property CampaignEmail[] $campaignEmails
 */
class EmailTemplates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_templates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name', 's_title', 's_email_template'], 'required'],
            [['s_email_template'], 'string'],
            [['s_name'], 'string', 'max' => 25],
            [['s_title'], 'string', 'max' => 100],
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
            's_title' => 'Title',
            's_email_template' => 'Email Template',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampaignEmails()
    {
        return $this->hasMany(CampaignEmail::className(), ['fk_i_template_id' => 'pk_i_id']);
    }
}

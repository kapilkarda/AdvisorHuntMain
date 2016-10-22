<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;


class EmailTemplates extends ActiveRecord
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

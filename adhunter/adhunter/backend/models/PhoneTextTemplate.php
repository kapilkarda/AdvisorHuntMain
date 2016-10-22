<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "phone_text_template".
 *
 * @property integer $pk_i_id
 * @property string $s_name
 * @property integer $i_template_type
 * @property string $s_template
 * @property string $dt_created_date
 * @property string $dt_deleted_at
 */
class PhoneTextTemplate extends \yii\db\ActiveRecord
{

    public $s_template_file;
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phone_text_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_name', 'i_template_type', 's_template'], 'required'],
            [['i_template_type'], 'integer'],
            [['dt_created_date', 'dt_deleted_at'], 'safe'],
            [['s_name'], 'string', 'max' => 25],
        	[['file'],'file'],
            [['s_template'], 'string', 'max' => 250],
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
            'i_template_type' => 'Template Type',
            's_template' => 'Template',
            'dt_created_date' => 'Created At',
            'dt_deleted_at' => 'Deleted At',
        	'file' =>'Choose XML File'
        ];
    }
}

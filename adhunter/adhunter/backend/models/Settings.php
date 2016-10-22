<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $s_settings_name
 * @property string $s_settings_value
 * @property string $b_status
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_settings_name', 's_settings_value', 'b_status'], 'required'],
            [['b_status'], 'integer', 'max' => 1],
            [['s_settings_name','s_settings_value', 'b_status'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            's_settings_name' => 'Settings Name',
            's_settings_value' => 'Settings Value',
            'b_status' => 'Status',
        ];
    }
}

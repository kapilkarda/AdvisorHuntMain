<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "promo_code".
 *
 * @property integer $pk_i_id
 * @property string $i_code
 * @property integer $i_no_of_tokens
 * @property string $dt_start_date
 * @property string $dt_end_date
 * @property string $dt_created_at
 * @property string $dt_deleted_at
 */
class PromoCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'promo_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['i_code', 'i_no_of_tokens', 'dt_start_date', 'dt_end_date'], 'required'],
            [['i_no_of_tokens'], 'integer'],
            [['dt_start_date', 'dt_end_date'], 'safe'],
            [['i_code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'i_code' => 'Code',
            'i_no_of_tokens' => 'No Of Tokens',
            'dt_start_date' => 'Start Date',
            'dt_end_date' => 'End Date',
           // 'dt_created_at' => 'Dt Created At',
           // 'dt_deleted_at' => 'Dt Deleted At',
        ];
    }
}

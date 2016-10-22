<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "token_counts".
 *
 * @property integer $pk_i_id
 * @property string $s_token_count_slab
 * @property integer $i_token_count
 * @property double $f_price
 * @property string $s_validity_days
 */
class TokenCounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token_counts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['s_token_count_slab', 'i_token_count', 'f_price', 's_validity_days'], 'required'],
            [['i_token_count'], 'integer'],
            [['f_price'], 'number'],
            [['s_token_count_slab', 's_validity_days'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            's_token_count_slab' => 'Token Count Slab',
            'i_token_count' => 'No of Tokens',
            'f_price' => 'Price',
            's_validity_days' => 'Validity Days',
        ];
    }
}

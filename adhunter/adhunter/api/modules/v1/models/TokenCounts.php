<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

use Yii;

class TokenCounts extends ActiveRecord
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

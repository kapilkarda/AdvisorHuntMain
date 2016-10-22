<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
use Yii;
//use webvimark\modules\UserManagement\models\User;

class TokenBalance extends ActiveRecord
{
    public $User;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token_balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_user_id', 'i_prev_balance', 'i_current_balance', 'dt_last_purchase_date', 'dt_last_used_date'], 'required'],
            [['fk_i_user_id', 'i_prev_balance', 'i_current_balance'], 'integer'],
            [['dt_last_purchase_date', 'dt_last_used_date'], 'safe'],
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
            'fk_i_user_id' => 'Company ',
            'i_prev_balance' => 'Prev Balance',
            'i_current_balance' => 'Current Balance',
            'dt_last_purchase_date' => 'Last Purchase Date',
            'dt_last_used_date' => 'Last Used Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_i_user_id']);
    }
}

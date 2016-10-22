<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

class BackgroundCheck extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'background_check';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_company_id', 'dt_bg_check_date', 's_bg_check_agency', 's_bg_check_report_image', 'i_bg_check_status', 's_bg_check_comments', 's_bg_check_validity'], 'required'],
            [['fk_i_company_id', 'i_bg_check_status'], 'integer'],
            [['dt_bg_check_date'], 'safe'],
            [['s_bg_check_agency', 's_bg_check_comments'], 'string', 'max' => 255],
            [['s_bg_check_report_image', 's_bg_check_validity'], 'string', 'max' => 100],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_company_id' => 'Company ',
            'dt_bg_check_date' => 'Bg Check Date',
            's_bg_check_agency' => 'Bg Check Agency',
            's_bg_check_report_image' => 'Bg Check Report Image',
            'i_bg_check_status' => 'Bg Check Status',
            's_bg_check_comments' => 'Bg Check Comments',
            's_bg_check_validity' => 'Bg Check Validity',
        ];
    }
}

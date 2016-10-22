<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "company_license".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_state_id
 * @property string $s_accreditation
 * @property string $s_license_details
 * @property string $dt_expiration
 * @property integer $fk_i_company_id
 */
class CompanyLicense extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_license';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_state_id', 's_accreditation', 's_accreditation_hash', 's_license_details', 'dt_expiration', 'fk_i_company_id'], 'required'],
            [['fk_i_state_id', 'fk_i_company_id'], 'integer'],
            [['dt_expiration'], 'safe'],
            [['s_accreditation', 's_accreditation_hash'], 'string', 'max' => 100],
            [['s_license_details'], 'string', 'max' => 255],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
            [['fk_i_state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['fk_i_state_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_state_id' => 'State ',
            's_accreditation' => 'Accreditation',
            's_accreditation_hash' => 'Accreditation#',
            's_license_details' => 'License Details',
            'dt_expiration' => 'Expiration',
            'fk_i_company_id' => 'Company',
        ];
    }
}

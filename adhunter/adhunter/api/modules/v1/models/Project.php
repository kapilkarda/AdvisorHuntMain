<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

//use webvimark\modules\UserManagement\models\User;

use Yii;


class Project extends ActiveRecord
{
      public $zip;
    public $User;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_requested_by', 's_name', 'i_type', 'f_cost', 's_duration','fk_i_company_id','zip'], 'required'],
            [['fk_i_requested_by', 'fk_i_zip_id', 'fk_i_company_id','zip'], 'integer'],
            [['f_cost'], 'number'],
            [['s_description'], 'string'],
            [['dt_created_at'], 'safe'],
            [['s_name'], 'string', 'max' => 255],
            [['s_duration'], 'string', 'max' => 200],
            [['s_address'], 'string', 'max' => 500],
           // [['fk_i_zip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['fk_i_zip_id' => 'zip']],
            [['fk_i_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['fk_i_company_id' => 'id']],
//            [['fk_i_requested_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_i_requested_by' => 'id']],
            [['zip'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip' => 'zip']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'ID',
            'fk_i_requested_by' => 'Requested By',
            's_name' => 'Name',
            'i_type' => 'Type',
            'f_cost' => 'Cost',
            's_duration' => 'Duration',
            's_description' => 'Description',
            's_address' => 'Address',
            'fk_i_zip_id' => 'Zip ',
            'fk_i_company_id' => 'Company ',
            'dt_created_at' => 'Created Date',
            'dt_deleted_at' => 'Deleted Date',
            'zip' => 'Zip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIZip()
    {
        return $this->hasOne(Zipcode::className(), ['id' => 'fk_i_zip_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkICompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'fk_i_company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIRequestedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_i_requested_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectImages()
    {
        return $this->hasMany(ProjectImage::className(), ['fk_i_project_id' => 'pk_i_id']);
    }
}

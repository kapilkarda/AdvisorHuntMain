<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "project_image".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_project_id
 * @property integer $fk_uploaded_by_id
 * @property string $s_image_alt_details
 * @property string $s_image
 * @property integer $b_status
 * @property string $dt_deleted_at
 *
 * @property Project $fkIProject
 */
class ProjectImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $file;
	
    public static function tableName()
    {
        return 'project_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_project_id', 'fk_uploaded_by_id', 's_image_alt_details', 'b_status'], 'required'],
            [['fk_i_project_id', 'fk_uploaded_by_id', 'b_status'], 'integer'],
            [['dt_deleted_at', 'd_upload_date'], 'safe'],
            [['s_image_alt_details', 's_image'], 'string', 'max' => 100],
            [['fk_i_project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['fk_i_project_id' => 'pk_i_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'ID',
            'fk_i_project_id' => 'Project ID',
            'fk_uploaded_by_id' => 'Uploaded By',
            's_image_alt_details' => 'ALT Text',
            's_image' => 'Image',
        	'd_upload_date' => 'Date',
            'b_status' => 'Status',
            'dt_deleted_at' => 'Deleted At',
        	'file' =>'Upload a File',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIProject()
    {
        return $this->hasOne(Project::className(), ['pk_i_id' => 'fk_i_project_id']);
    }
}

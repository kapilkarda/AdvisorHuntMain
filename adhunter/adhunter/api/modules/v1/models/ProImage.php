<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "pro_image".
 *
 * @property integer $pk_i_id
 * @property integer $fk_i_pro_user_id
 * @property integer $fk_i_project_id
 * @property string $s_image_type
 * @property string $s_image
 * @property string $s_image_alt_details
 * @property string $d_upload_date
 * @property integer $b_status
 * @property string $dt_deleted_at
 *
 * @property User $fkIProUser
 */
class ProImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pro_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_pro_user_id', 'fk_i_project_id', 's_image_type', 's_image', 's_image_alt_details', 'b_status'], 'required'],
            [['fk_i_pro_user_id', 'fk_i_project_id', 'b_status'], 'integer'],
            [['d_upload_date', 'dt_deleted_at'], 'safe'],
            [['s_image_type', 's_image', 's_image_alt_details'], 'string', 'max' => 100],
            [['fk_i_pro_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['fk_i_pro_user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_pro_user_id' => 'Fk I Pro User ID',
            'fk_i_project_id' => 'Fk I Project ID',
            's_image_type' => 'S Image Type',
            's_image' => 'S Image',
            's_image_alt_details' => 'S Image Alt Details',
            'd_upload_date' => 'D Upload Date',
            'b_status' => 'B Status',
            'dt_deleted_at' => 'Dt Deleted At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkIProUser()
    {
        return $this->hasOne(User::className(), ['id' => 'fk_i_pro_user_id']);
    }
}

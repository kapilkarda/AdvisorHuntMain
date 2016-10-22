<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

use Yii;

class Token extends ActiveRecord
{
     public $zip;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_i_sub_category_id', 'i_project_cost_range_from', 'i_project_cost_range_to', 'i_token_count', 'zip'], 'required'],
            [['fk_i_sub_category_id', 'i_project_cost_range_from', 'i_project_cost_range_to', 'i_token_count', 'zip'], 'integer'],
            [['fk_i_sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subcategory::className(), 'targetAttribute' => ['fk_i_sub_category_id' => 'id']],
            // [['fk_i_zip_id'], 'exist', 'skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['fk_i_zip_id' => 'zip']],
            [['zip'], 'exist','skipOnError' => true, 'targetClass' => Zipcode::className(), 'targetAttribute' => ['zip' => 'zip']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pk_i_id' => 'Pk I ID',
            'fk_i_sub_category_id' => 'Sub Category',
            'fk_i_zip_id' => 'Zip',
            'i_project_cost_range_from' => 'Project Cost Range From',
            'i_project_cost_range_to' => 'Project Cost Range To',
            'i_token_count' => 'Token Count',
            'zip' => 'Zip',
        ];
    }
}

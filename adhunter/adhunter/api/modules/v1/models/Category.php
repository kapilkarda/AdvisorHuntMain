<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;

class Category extends \yii\db\ActiveRecord
{
        public $imagei;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['image'], 'string', 'max' => 100],
            [['b_front_page'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'imagei' => 'Image',
            'b_front_page'=>'Show Front Page',
        ];
    }
}

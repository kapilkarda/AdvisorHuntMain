<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
use Yii;

class Subcategory extends ActiveRecord
{     public $image;
    public $category;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subcategory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'category_id'], 'required'],
            [['category_id','b_front_page'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],

            [['s_image'], 'string', 'max' => 100],

        	[['b_front_page'], 'integer'],
            [['category'], 'safe']
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
            'category_id' => 'Category',
            'image' => 'Image',
	    	'b_front_page'=>'Show Front Page',
        	's_image' => 'Image',
        	'b_front_page' => 'Front Page',

        ];
    }

    /**
     * @return get category
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getSubCategory()
    {
       return $this->find(1);
    }
}

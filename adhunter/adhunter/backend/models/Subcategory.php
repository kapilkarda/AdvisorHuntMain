<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "subcategory".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $category_id
 */
class Subcategory extends \yii\db\ActiveRecord
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

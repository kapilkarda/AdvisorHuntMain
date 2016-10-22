<?php
namespace frontend\models;

use yii\base\Model;
use Yii;
use yii\web\UploadedFile;

class UploadProfilePic extends Model 
{
	  /**
     * @var UploadedFile
     */
	public $profile_pic;

	public function rules()
	{

		return [
            ['profile_pic', 'required'],
            [['profile_pic'], 'file', 'extensions' => 'png, jpg, jpeg, gif'],
        ];
	}
	/**
	 * @upload profile pic	 */
	public function upload()
	{
    	$this->profile_pic = UploadedFile::getInstance($this, 'profile_pic');
    	// print_r($this->profile_pic);die("SDS");
        if ($this->validate()) {
        	// print_r($this);die("sa");
        	
            $this->profile_pic->saveAs('assets/img/team/' . $this->profile_pic->baseName . '.' . $this->profile_pic->extension);
            return true;
        } else {
            return false;
        }
    }
	
}

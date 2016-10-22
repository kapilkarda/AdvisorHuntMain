<?php

namespace api\modules\v1\controllers;

use yii;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\filters\AccessControl;
use \api\modules\v1\models\CompanyServices;
use \api\modules\v1\models\CompanyLicense;
use \api\modules\v1\models\BackgroundCheck;
use \api\modules\v1\models\CompanyServiceArea;
use \api\modules\v1\models\CompanyReviewComment;
use \api\modules\v1\models\CompanyRating;
use \api\modules\v1\models\Project;
use \api\modules\v1\models\Company;
use \api\modules\v1\models\Zipcode;
use \api\modules\v1\models\CompanyProject;
use yii\filters\auth\HttpBearerAuth;
use \webvimark\modules\UserManagement\models\User;
use \webvimark\modules\UserManagement\components\UserAuthEvent;
use \api\modules\v1\models\TokenBalance;
use yii\imagine\Image;

use yii\helpers\ArrayHelper;

use yii\web\Response;


/**
 * CompanyController API
 *
 */
class CompanyController  extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Company';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className(),
//        ];
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    public function actions()
	{
	    $actions = parent::actions();

	    // disable the "delete"  actions
	    unset($actions['delete']);
	     unset($actions['create']);

	    // customize the data provider preparation with the "prepareDataProvider()" method
	    // $actions['create']['prepareDataProvider'] = [$this, 'customcreate'];
	    // echo"<pre>";print_r($actions['test']);echo"<pre>";die("@@@");

	    return $actions;
	}

	public function actionCreate(){
       $model = new Company();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->validate()){
         	//print_r(\Yii::$app->getRequest()->getBodyParam('main_category')['id']	);	die();
                $zip = Zipcode::find()
                    ->where('zip = :zip', [':zip' =>  \Yii::$app->getRequest()->getBodyParam('zip')])
                    ->one();
                $model->zip_id = $zip->id;    
                $model->attributes=\Yii::$app->getRequest()->getBodyParams();   
                $model->active_company_flag = 1;
                $model->closed_company_flag = 0;         
                $model->dt_deleted_at = null;
                $model->save();
         		if ($model->save()) {
					$tokenbalance = new TokenBalance();
	                $tokenbalance->i_prev_balance = 0;
	                $tokenbalance->i_current_balance = 0;
	                $tokenbalance->fk_i_user_id = $model->id;
	                $tokenbalance->dt_last_purchase_date = 0;
	                $tokenbalance->dt_last_used_date = 0;                      
	                $tokenbalance->save();
 					\Yii::$app->db->createCommand('INSERT INTO `company_serivces` (`fk_i_company_id`, `fk_i_service_id`) VALUES (:company,:subcategroy)', [
                            ':company' => $model->id,':subcategroy' => \Yii::$app->getRequest()->getBodyParam('main_category')['id']
                        ])->execute();              

               		return $response = [
                            'status' => 1,
                            'company_id' => $model->id
                        ];
            }
        }           
        else {
             $model->validate();
               return $model;
        }

    }

    public function actionServiceAreaByCompany($companyid)
	{
		$areas = CompanyServiceArea::find()
                  ->where('fk_i_company_id = :fk_i_company_id', [':fk_i_company_id' => $companyid])
                  ->andWhere(['IS','dt_deleted_at',null])
                  ->all();
        if($areas)
			return $areas;
		else{
			return 0;
		}
				
	} 
	public function actionServicesByCompany($companyid)
	{
        $model = new Company;
		$services = $model->getCategorysOfCompany($companyid);
		if($services)
			return $services;
		else{
			return 0;
		}
		 	
	} 
	public function actionCompanyBackcheckByCompany($companyid)
	{
		$back_checks = BackgroundCheck::find()
                ->where('fk_i_company_id = :company_id', [':company_id' => $companyid])
                ->andWhere(['IS','dt_deleted_at',null])
                ->all();  
		if($back_checks)
			return $back_checks;
		else{
			return 0;
		}
		 	
	} 
	public function actionLiecenseByCompany($companyid)
	{
		$company_licenses = CompanyLicense::find()
                ->where('fk_i_company_id = :company_id', [':company_id' => $companyid])
                ->andWhere(['IS','dt_deleted_at',null])
                ->all(); 
		if($company_licenses)
			return $company_licenses;
		else{
			return 0;
		}
		 	
	} 

	public function actionSaveServiceArea()
	{  	
		if (\Yii::$app->getRequest()->getBodyParams())
        {
        	$exist = \Yii::$app->db->createCommand('SELECT * FROM company_service_area WHERE fk_i_company_id = '.\Yii::$app->getRequest()->getBodyParam('proid').' AND fk_i_service_area_zip = '.\Yii::$app->getRequest()->getBodyParam('zipid').' AND dt_deleted_at IS NULL')->queryAll();
			if(!$exist){
				$company =\Yii::$app->db->createCommand('INSERT INTO `company_service_area` (`fk_i_company_id`, `fk_i_service_area_zip`, `dt_deleted_at`) VALUES (:company,:zipid,:deletedate)', [
	                    ':company' => \Yii::$app->getRequest()->getBodyParam('proid'),':zipid' => \Yii::$app->getRequest()->getBodyParam('zipid'), ':deletedate' => null
	                ])->execute();
				if($company)
					return 1;
				else
					return 0; 
			}else{
				return 2;
			}
        }
        else
			return 0;          	
	}

	public function actionDeleteServiceArea()
	{  	
		if (\Yii::$app->getRequest()->getBodyParams())
        {
				$company = \Yii::$app->db->createCommand('UPDATE company_service_area SET dt_deleted_at = "'.date("Y-m-d h:i:s").'" WHERE fk_i_company_id = '.\Yii::$app->getRequest()->getBodyParam('proid').' AND fk_i_service_area_zip = '.\Yii::$app->getRequest()->getBodyParam('zipid'))->execute();
				if($company)
					return 1;
				else
					return 0; 
        }
        else
			return 0; 	
	}

	public function actionCompanyReviewsByCompany($companyid)
	{
        $reviews = CompanyReviewComment::find()
				->where(['fk_i_company_id' => $companyid])
				->andWhere(['IS','dt_deleted_at',null])
        				->all(); 
		if($reviews){
			return $reviews;
		}
		else{
			return 0;
		}
		 	
	} 
	public function actionRatingsByReview($reviewid)
	{
		$ratings = CompanyRating::find()
			->where(['fk_i_comment_id' => $reviewid])
			->andWhere(['IS','dt_deleted_at',null])
			->all();
		if($ratings){
			return $ratings;
		}
		else{
			return 0;
		}
		 	
	} 
	public function actionProjectByCompany($companyid)
	{
		$projects = Project::find()
			->where(['fk_i_company_id' => $companyid])
			->andWhere(['IS','dt_deleted_at',null])
			->all();
		if($projects){
			return $projects;
		}
		else{
			return 0;
		}
		 	
	}

	//Added by Aninda

    public function actionProfileprojectByCompany($companyid)
    {
        $CompanyProfileProject = CompanyProject::find()
            ->where(['fk_i_pro_id' => $companyid])
            ->andWhere(['IS','dt_deleted_at',null])
            ->all();
        if($CompanyProfileProject){
            return $CompanyProfileProject;
        }
        else{
            return 0;
        }

    }

	public function actionImagesByProject($projectid)
	{
		$images = \Yii::$app->db->createCommand('SELECT * FROM `project_image` WHERE dt_deleted_at IS NULL AND fk_i_project_id = '.$projectid)->queryAll();
		if($images)
			return $images;
		else{
			return 0;
		}
	 	
	}

	public function actionUpdateCompanyName()
	{  	 //return \Yii::$app->getRequest()->getBodyParam('name');
		$company = \Yii::$app->db->createCommand('UPDATE company SET name = "'.\Yii::$app->getRequest()->getBodyParam('name').'" WHERE id = '.\Yii::$app->getRequest()->getBodyParam('id') )->execute();
		if($company)
			return 1;
		else
			return 0; 	
	}

	public function actionUpdateCompanyAbout()
	{  	 
		$company = \Yii::$app->db->createCommand('UPDATE company SET about = "'.\Yii::$app->getRequest()->getBodyParam('about').'", year_founded = "'.\Yii::$app->getRequest()->getBodyParam('year_founded').'", website = "'.\Yii::$app->getRequest()->getBodyParam('website').'" WHERE id = '.\Yii::$app->getRequest()->getBodyParam('id') )->execute();
		if($company)
			return 1;
		else
			return 0; 	
	}

	public function actionUpdateCompanyPersonalinfo()
	{  	
		$company = \Yii::$app->db->createCommand('UPDATE company SET mobile = "'.\Yii::$app->getRequest()->getBodyParam('mobile').'", phone = "'.\Yii::$app->getRequest()->getBodyParam('phone').'", email = "'.\Yii::$app->getRequest()->getBodyParam('email').'", address = "'.\Yii::$app->getRequest()->getBodyParam('address').'", zip_id = "'.\Yii::$app->getRequest()->getBodyParam('zip_id').'", city_id = "'.\Yii::$app->getRequest()->getBodyParam('city_id').'", state_id = "'.\Yii::$app->getRequest()->getBodyParam('state_id').'", country_id = "'.\Yii::$app->getRequest()->getBodyParam('country_id').'" WHERE id = '.\Yii::$app->getRequest()->getBodyParam('id') )->execute();
		if($company)
			return 1;
		else
			return 0; 	
	}

	public function actionUpdateCompanyServices()
	{  		
		// return \Yii::$app->getRequest()->getBodyParam('services');
		if(Yii::$app->getRequest()->getBodyParams()){
			\Yii::$app->db->createCommand()->delete('company_serivces', ['fk_i_company_id' => \Yii::$app->getRequest()->getBodyParam('proid')])->execute();       
            foreach (\Yii::$app->getRequest()->getBodyParam('services') as $value) {
                \Yii::$app->db->createCommand('INSERT INTO `company_serivces` (`fk_i_company_id`, `fk_i_service_id`) VALUES (:company,:subcategroy)', [
                    ':company' => \Yii::$app->getRequest()->getBodyParam('proid'),':subcategroy' => $value
                ])->execute();             
            }
			return 1;
		}		
		else{
			return 0; 	
		}
	}

	public function actionUpdateCompanyLicense()
	{  		
		$model = new CompanyLicense();
		if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->validate())
        {       
              
            $company_licenses = CompanyLicense::findone(Yii::$app->getRequest()->getBodyParam('pk_i_id'));
            $company_licenses->fk_i_state_id = Yii::$app->getRequest()->getBodyParam('fk_i_state_id');
            $company_licenses->s_accreditation = Yii::$app->getRequest()->getBodyParam('s_accreditation');
            $company_licenses->s_accreditation_hash = Yii::$app->getRequest()->getBodyParam('s_accreditation_hash');
            $company_licenses->s_license_details = Yii::$app->getRequest()->getBodyParam('s_license_details');
			$company_licenses->dt_expiration = Yii::$app->getRequest()->getBodyParam('dt_expiration');
			$company_licenses->fk_i_company_id = Yii::$app->getRequest()->getBodyParam('fk_i_company_id');
			if($company_licenses->save())
				return 1;
			else{
				return 0;
			}
        }else{
            $model->validate();
            return $model;
        }
	}

	public function actionUpdateCompanyBanner()
	{  	//return \Yii::$app->getRequest()->getBodyParam('mobile');

		if(isset($_FILES["file"]["type"]) && isset($_POST['proid']))
		{
			$companyid = $_POST['proid'];
			// return $_FILES["file"]["type"];
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
			) && ($_FILES["file"]["size"] < 200000)//Approx. 200kb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {
				if ($_FILES["file"]["error"] > 0)
				{
					return "Return Code: " . $_FILES["file"]["error"];
				}
				else
				{
					
					$imageName = 'banner'.$companyid.'.'.$file_extension;
       
					 	$localImagePath = 'uploads/banner/'.$imageName;
                            $localImageThumbPath = 'uploads/banner/thumbs/'.$imageName;
                             $localImageMidsizeThumbPath = 'uploads/banner/thumbs/midsize/'.$imageName;

                            move_uploaded_file($_FILES['file']['tmp_name'],$localImagePath);
                            Image::thumbnail( $localImagePath, 100, 100)
                                ->save($localImageThumbPath, ['quality' => 50]);
                            Image::thumbnail( $localImagePath, 1270, 300)//250, 186
                            	->save($localImageMidsizeThumbPath, ['quality' => 50]);

                            \Yii::$app->get('s3bucket')->put('banner/'.$imageName, fopen($localImagePath, 'r+'));
                            \Yii::$app->get('s3bucket')->put('banner/thumbs/'.$imageName, fopen($localImageThumbPath, 'r+'));
                            \Yii::$app->get('s3bucket')->put('banner/thumbs/midsize/'.$imageName, fopen($localImageMidsizeThumbPath, 'r+'));
                            // \Yii::$app->Helpers->uploadToS3($localImagePath, 'banner/'.$imageName);  
                            // \Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'banner/thumbs/'.$imageName);     
                            // \Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'banner/thumbs/midsize/'.$imageName);                           

                            $company = \Yii::$app->db->createCommand('UPDATE company SET banner = "'.$imageName.'" WHERE id = '.$companyid )->execute();
	
//                             Commented to fix image update issue  - Aninda 9/13/2016
//                            unlink($localImagePath);
//                            unlink($localImageThumbPath);
//                            unlink($localImageMidsizeThumbPath);
                             
                            return 1;
				}
			}
			else
			{
				return "Invalid file Size or Type";
			}
		}
	}

    public function actionUpdateCompanyPic()
	{

		if(isset($_FILES["file"]["type"]) && isset($_POST['proidp']))
		{
			$companyid = $_POST['proidp'];
			// return $_FILES["file"]["type"];
			$validextensions = array("jpeg", "jpg", "png");
			$temporary = explode(".", $_FILES["file"]["name"]);
			$file_extension = end($temporary);
			if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
			) && ($_FILES["file"]["size"] < 200000)//Approx. 200kb files can be uploaded.
			&& in_array($file_extension, $validextensions)) {
				if ($_FILES["file"]["error"] > 0)
				{
					return "Return Code: " . $_FILES["file"]["error"];
				}
				else
				{
					
					$imageName = 'company_profile_pic'.$companyid.'.'.$file_extension;
       
					 	$localImagePath = 'uploads/profile/'.$imageName;
                            $localImageThumbPath = 'uploads/profile/thumbs/'.$imageName;
                             $localImageMidsizeThumbPath = 'uploads/profile/thumbs/midsize/'.$imageName;

                            move_uploaded_file($_FILES['file']['tmp_name'],$localImagePath);
                            Image::thumbnail( $localImagePath, 100, 100)
                                ->save($localImageThumbPath, ['quality' => 50]);
                            Image::thumbnail( $localImagePath, 250, 186)//250, 186
                            	->save($localImageMidsizeThumbPath, ['quality' => 50]);

                            \Yii::$app->get('s3bucket')->put('profile/'.$imageName, fopen($localImagePath, 'r+'));
                            \Yii::$app->get('s3bucket')->put('profile/thumbs/'.$imageName, fopen($localImageThumbPath, 'r+'));
                            \Yii::$app->get('s3bucket')->put('profile/thumbs/midsize/'.$imageName, fopen($localImageMidsizeThumbPath, 'r+'));
                            
                            $company = \Yii::$app->db->createCommand('UPDATE company SET profile_pic = "'.$imageName.'" WHERE id = '.$companyid )->execute();
	

                            unlink($localImagePath);
                            unlink($localImageThumbPath);
                            unlink($localImageMidsizeThumbPath);
                             
                            return 1;
				}
			}
			else
			{
				return "Invalid file Size or Type";
			}
		}
	}
	
    public function actionSaveCompanyRatingReview()
    {
	$model = new CompanyReviewComment();

	//$model->attributes=\Yii::$app->getRequest()->getBodyParams();   
	//print_r($model);die("hiii");
	
        $companycomment =\Yii::$app->db->createCommand('INSERT INTO `company_review_comment`
       (`fk_i_company_id`,`s_review_by`,`s_review_comment`,`fk_i_project_id`,`i_status`,`dt_review_date`,`dt_deleted_at` )
       VALUES (:companyid,:review,:reviewcomment,:projid,:status,:reviewdate, :deletedate)', [
        ':companyid' => \Yii::$app->getRequest()->getBodyParam('fk_i_company_id'),':review' => \Yii::$app->getRequest()->getBodyParam('s_review_by'),
	':reviewcomment' => \Yii::$app->getRequest()->getBodyParam('s_review_comment'),':projid' => \Yii::$app->getRequest()->getBodyParam('fk_i_project_id'),
	':status' => \Yii::$app->getRequest()->getBodyParam('i_status'),':reviewdate' => \Yii::$app->getRequest()->getBodyParam('dt_review_date'), ':deletedate' => null
       ])->execute();
        //$insert_id = Yii::$app->db->getLastInsertID();
    
       if($companycomment)
       {
	$insert_id = Yii::$app->db->getLastInsertID();
	 $companyRating =\Yii::$app->db->createCommand('INSERT INTO `company_rating`
        (`pk_i_id`,`fk_i_company_id`,`s_rating_category`,`i_rating`,`s_review_by`,`fk_i_comment_id`,`dt_review_date`,`dt_deleted_at` )
        VALUES (:id,:companyid,:ratingcat,:rating,:review,:commentid,:reviewdate, :deletedate)', [
        ':id' => \Yii::$app->getRequest()->getBodyParam('pk_i_id'),':companyid' => \Yii::$app->getRequest()->getBodyParam('fk_i_company_id'),
	':ratingcat' => \Yii::$app->getRequest()->getBodyParam('s_rating_category'),':rating' => \Yii::$app->getRequest()->getBodyParam('i_rating'),
	':review' => \Yii::$app->getRequest()->getBodyParam('s_review_by'),':commentid' => \Yii::$app->getRequest()->getBodyParam('fk_i_comment_id'),
	':reviewdate' => \Yii::$app->getRequest()->getBodyParam('dt_review_date'),':deletedate' => null
       ])->execute();
   
       }
       else
       {
	return 0;
       }
		    
	
    }
}

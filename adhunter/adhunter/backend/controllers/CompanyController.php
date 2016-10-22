<?php

namespace backend\controllers;

use Yii;
use backend\models\Company;
use backend\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\City;
use yii\web\UploadedFile;
use yii\helpers\Json;
use backend\models\Zipcode;
use yii\filters\AccessControl;
use backend\models\TokenBalance;
use backend\models\PurchaseOrder;
use backend\models\TokenPromo;
use yii\imagine\Image;
use backend\models\PromoCode;


/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
	     'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['index', 'create', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'tokenmanagement', 'comments','closeaccount','fullrefund','partialrefund', 'promotional-token','activate', 'deactivate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	    // validate if there is a editable input saved via AJAX
	    if (Yii::$app->request->post('hasEditable')) {
	        // instantiate your book model for saving
	        $companyId = Yii::$app->request->post('editableKey');
	        // return json_encode(current($_POST['Company'])[$_POST['editableAttribute']]); 
	    	// $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
	    	$up = Yii::$app->db->createCommand('UPDATE `company` SET '.$_POST['editableAttribute'].' = "'.current($_POST['Company'])[$_POST['editableAttribute']].'" WHERE company.id = '.$companyId)->execute();
	        // can save model or do something before saving model      	       
			return json_encode($up);
	    }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Lists all Company models with token management.
     * @return mixed
     */
    public function actionTokenmanagement()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('tokenmanagement', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Company models with Comments.
     * @return mixed
     */
    public function actionComments()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $commentId = Yii::$app->request->post('editableKey');

            $up = Yii::$app->db->createCommand('UPDATE `company_review_comment` SET '.$_POST['editableAttribute'].' = "'.current($_POST['CompanyReviewComment'])[$_POST['editableAttribute']].'" WHERE company_review_comment.pk_i_id = '.$commentId)->execute();
            // can save model or do something before saving model              
            return json_encode($up);
        }
        return $this->render('comments', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($model->load(Yii::$app->request->post())) {
                $model->attributes=$_POST['Company'];

                $zip = Zipcode::find()
                    ->where('zip = :zip', [':zip' =>  $_POST['Company']['zip']])
                    ->one();
                    if(isset($zip->id)){
                        $model->zip_id = $zip->id;
                    }                      
                    else{
                        $model->addError('zip', "Invalid Zip");
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }

                 $userExist = Company::find()
                    ->where('user_id = :user_id', [':user_id' =>  $_POST['Company']['user_id']])
                    ->one();
                if($userExist){
                    Yii::$app->session->setFlash('danger', 'This user is already associted with another company');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }

                //  $city = City::find()
                // ->where('name = :name', [':name' => $_POST['Company']['city']])
                // ->one();                 

                //     if(isset($city->id)){
                //           $model->city_id = $city->id;
                //     }                      
                //     else{
                //         $model->addError('city', "Invalid City name
                //             ");
                //         return $this->render('create', [
                //             'model' => $model,
                //         ]);
                //     }

                 $model->dt_deleted_at = null;
                 $model->save();
              
              // print_r($_POST['Company']['city']); $model->save();print_r($model->errors);die("ss");
         
                  if ($model->save()) {
                $isRole = \Yii::$app->db->createCommand('SELECT * FROM auth_assignment WHERE item_name = "Provider" AND user_id = '.$_POST['Company']['user_id'])->queryAll();
                    // print_r($isRole);die();
                    if(empty($isRole))
                        \Yii::$app->db->createCommand('INSERT INTO auth_assignment(item_name, user_id) values ("Provider", '.$_POST['Company']['user_id'].')')->execute();
                 
                $tokenbalance = new TokenBalance();
                $tokenbalance->i_prev_balance = 0;
                $tokenbalance->i_current_balance = 0;
                $tokenbalance->fk_i_user_id = $model->id;   
                $tokenbalance->dt_last_purchase_date = 0;
                $tokenbalance->dt_last_used_date = 0;
                       
                $tokenbalance->save();

                  if($model->image)
                    {    
                          $imageName = 'company_profile_pic'.'_'.$model->id.'.'.$model->image->extension;
       
                          $localImagePath = 'uploads/profile/'.$imageName;
                          $localImageThumbPath = 'uploads/profile/thumbs/'.$imageName;
                           $localImageMidsizeThumbPath = 'uploads/profile/thumbs/midsize/'.$imageName;

                          $model->image->saveAs($localImagePath);
                          Image::thumbnail( $localImagePath, 100, 100)
                              ->save($localImageThumbPath, ['quality' => 50]);
                              Image::thumbnail( $localImagePath, 250, 186)
                          ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                          Yii::$app->Helpers->uploadToS3($localImagePath, 'profile/'.$imageName);  
                          Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'profile/thumbs/'.$imageName);     
                          Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'profile/thumbs/midsize/'.$imageName);                           
                      $model->profile_pic = $imageName;
                      $model->save();

                       unlink($localImagePath);
                       unlink($localImageThumbPath);
                       unlink($localImageMidsizeThumbPath);

                      
                      }

          
                   $model->ibanner = UploadedFile::getInstance($model, 'ibanner');      
                      if($model->ibanner)
                        {  
                            $localImagePath = 'uploads/banner/'.$imageName;
                            $localImageThumbPath = 'uploads/banner/thumbs/'.$imageName;
                             $localImageMidsizeThumbPath = 'uploads/banner/thumbs/midsize/'.$imageName;

                            $model->ibanner->saveAs($localImagePath);
                            Image::thumbnail( $localImagePath, 100, 100)
                                ->save($localImageThumbPath, ['quality' => 50]);
                                Image::thumbnail( $localImagePath, 250, 186)
                            ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                            Yii::$app->Helpers->uploadToS3($localImagePath, 'banner/'.$imageName);  
                            Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'banner/thumbs/'.$imageName);     
                            Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'banner/thumbs/midsize/'.$imageName);                           
                            
                            $model->banner = $imageName;
                            $model->save();
                            unlink($localImagePath);
                             unlink($localImageThumbPath);
                             unlink($localImageMidsizeThumbPath);

                        }
          
                   $model->invoice_logoi = UploadedFile::getInstance($model, 'invoice_logoi');
              
                    if($model->invoice_logoi!==null)
                      {  
                          $localImagePath = 'uploads/invoice_logo/'.$imageName;
                          $localImageThumbPath = 'uploads/invoice_logo/thumbs/'.$imageName;
                           $localImageMidsizeThumbPath = 'uploads/invoice_logo/thumbs/midsize/'.$imageName;

                          $model->invoice_logoi->saveAs($localImagePath);
                          Image::thumbnail( $localImagePath, 100, 100)
                              ->save($localImageThumbPath, ['quality' => 50]);
                              Image::thumbnail( $localImagePath, 250, 186)
                          ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                          Yii::$app->Helpers->uploadToS3($localImagePath, 'invoice_logo/'.$imageName);  
                          Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'invoice_logo/thumbs/'.$imageName);     
                          Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'invoice_logo/thumbs/midsize/'.$imageName);                           
                          $model->invoice_logo = $imageName;
                          $model->save();
                          unlink($localImagePath);
                           unlink($localImageThumbPath);
                           unlink($localImageMidsizeThumbPath);

                      }
                 
               $company_id = $model->id;
                if(isset($_POST['subcategory_id'])){         
                 Yii::$app->db->createCommand()->delete('company_serivces', ['fk_i_company_id' => $company_id])->execute();       
                    foreach ($_POST['subcategory_id'] as $key => $value) {
                        Yii::$app->db->createCommand('INSERT INTO `company_serivces` (`fk_i_company_id`, `fk_i_service_id`) VALUES (:company,:subcategroy)', [
                            ':company' => $company_id,':subcategroy' => $value
                        ])->execute();
                     //  echo "<br>".$value;                  
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }

         }
            
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	
          if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // $city = City::find()
            //     ->where('name = :name', [':name' => $_POST['Company']['city']])
            //     ->one();
            //      $model->attributes=$_POST['Company'];
            //      $model->city_id = $city->id;
                 
                  $zip = Zipcode::find()
                ->where('zip = :zip', [':zip' =>  $_POST['Company']['zip']])
                ->one();
                 $model->zip_id = $zip->id;

                 if ($model->save()) {
  
                            $model->image = UploadedFile::getInstance($model, 'image');
                         
                              if($model->image)
                                {    
                                    $imageName = 'company_profile_pic'.'_'.$model->id.'.'.$model->image->extension;
                 
                                    $localImagePath = 'uploads/profile/'.$imageName;
                                    $localImageThumbPath = 'uploads/profile/thumbs/'.$imageName;
                                     $localImageMidsizeThumbPath = 'uploads/profile/thumbs/midsize/'.$imageName;

                                    $model->image->saveAs($localImagePath);
                                    Image::thumbnail( $localImagePath, 100, 100)
                                        ->save($localImageThumbPath, ['quality' => 50]);
                                        Image::thumbnail( $localImagePath, 250, 186)
                                    ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                                    Yii::$app->Helpers->uploadToS3($localImagePath, 'profile/'.$imageName);  
                                    Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'profile/thumbs/'.$imageName);     
                                    Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'profile/thumbs/midsize/'.$imageName);                           
                                $model->profile_pic = $imageName;
                                $model->save();
                                  unlink($localImagePath);
                                 unlink($localImageThumbPath);
                                 unlink($localImageMidsizeThumbPath);
                                
                                }

                    
                             $model->ibanner = UploadedFile::getInstance($model, 'ibanner');      
                                if($model->ibanner)
                                  {  
                                      $localImagePath = 'uploads/banner/'.$imageName;
                                      $localImageThumbPath = 'uploads/banner/thumbs/'.$imageName;
                                       $localImageMidsizeThumbPath = 'uploads/banner/thumbs/midsize/'.$imageName;

                                      $model->ibanner->saveAs($localImagePath);
                                      Image::thumbnail( $localImagePath, 100, 100)
                                          ->save($localImageThumbPath, ['quality' => 50]);
                                          Image::thumbnail( $localImagePath, 250, 186)
                                      ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                                      Yii::$app->Helpers->uploadToS3($localImagePath, 'banner/'.$imageName);  
                                      Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'banner/thumbs/'.$imageName);     
                                      Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'banner/thumbs/midsize/'.$imageName);                           
                                      
                                      $model->banner = $imageName;
                                      $model->save();
                                      unlink($localImagePath);
                                       unlink($localImageThumbPath);
                                       unlink($localImageMidsizeThumbPath);
                                  }
                    
                             $model->invoice_logoi = UploadedFile::getInstance($model, 'invoice_logoi');
                        
                              if($model->invoice_logoi!==null)
                                {  
                                    $localImagePath = 'uploads/invoice_logo/'.$imageName;
                                    $localImageThumbPath = 'uploads/invoice_logo/thumbs/'.$imageName;
                                     $localImageMidsizeThumbPath = 'uploads/invoice_logo/thumbs/midsize/'.$imageName;

                                    $model->invoice_logoi->saveAs($localImagePath);
                                    Image::thumbnail( $localImagePath, 100, 100)
                                        ->save($localImageThumbPath, ['quality' => 50]);
                                        Image::thumbnail( $localImagePath, 250, 186)
                                    ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                                    Yii::$app->Helpers->uploadToS3($localImagePath, 'invoice_logo/'.$imageName);  
                                    Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'invoice_logo/thumbs/'.$imageName);     
                                    Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'invoice_logo/thumbs/midsize/'.$imageName);                           
                                    $model->invoice_logo = $imageName;
                                    $model->save();
                                    unlink($localImagePath);
                                    unlink($localImageThumbPath);
                                    unlink($localImageMidsizeThumbPath);
                                }

                            $company_id = $model->id;
                             if(isset($_POST['subcategory_id'])){                
                                foreach ($_POST['subcategory_id'] as $key => $value) {
                                    Yii::$app->db->createCommand('INSERT INTO `company_serivces` (`fk_i_company_id`, `fk_i_service_id`) VALUES (:company,:subcategroy)', [
                                        ':company' => $company_id,':subcategroy' => $value
                                    ])->execute();
                                }
                            }

                      return $this->redirect(['view', 'id' => $model->id]);
                  }
        } 
        else {
            // $city = City::findOne($model->city_id);
            // $model->city = $city->name;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         $model = $this->findModel($id);
         $model->dt_deleted_at = date("Y-m-d h:i:s");
         $model->save();
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //activate bulk 
    public function actionActivate()
    {
         if (Yii::$app->request->post()) {          
              Company::updateAll(['active_company_flag' => 1], ['in', 'id', explode(',', $_POST['records'])]);
          }
        return $this->redirect(['index']);
    }

    //deactivate bulk
    public function actionDeactivate()
    {
         if (Yii::$app->request->post()) {
                Company::updateAll(['active_company_flag' => 0], ['in', 'id', explode(',', $_POST['records'])]);
          }
        return $this->redirect(['index']);
    }

    public function actionCloseaccount($id)
    {
        $update = \Yii::$app->db->createCommand("UPDATE company SET closed_company_flag=1 WHERE id=:id")
            ->bindValue(':id', $id)
            ->execute();
          
        if($update){
            
            $user = TokenBalance::find()->where(['fk_i_user_id' => $id])->one();

            $token_promo = new TokenPromo();
            $token_promo->fk_i_company_id = $id;
            $token_promo->i_no_of_tokens = $user->i_current_balance;
            $token_promo->fk_i_provided_by = Yii::$app->user->id;
            $token_promo->pk_i_promo_id = 0;
            $token_promo->i_refund_type = 3;
            $token_promo->save();
            // print_r($token_promo->errors); die("$$$$$$$$$$");

            Yii::$app->db->createCommand('UPDATE `token_balance` SET i_prev_balance = "'.$user->i_current_balance.'", i_current_balance= 0 WHERE token_balance.fk_i_user_id = '.$id)->execute();
            Yii::$app->session->setFlash('success', 'Company account has closed forever.');

            //Email sedning to comapny about closed!!!!!!
        }else{
            Yii::$app->session->setFlash('danger', 'Something Error !');
        }
        return $this->redirect(['tokenmanagement']);
    }
    public function actionFullrefund($id)
    {  
       $purchase = PurchaseOrder::find()
                ->where('fk_i_user_id = :company_id', [':company_id' => $id])
                ->all();
        if(count($purchase) == 1){
            // echo $purchase[0]->f_purchase_amount;die();
            $tokenbalance = TokenBalance::find()->where(['fk_i_user_id' => $id])->one();
            $update = Yii::$app->db->createCommand('UPDATE `token_balance` SET i_prev_balance = "'.$tokenbalance->i_current_balance.'", i_current_balance= 0 WHERE token_balance.fk_i_user_id = '.$id)->execute();
            if($update){
                $token_promo = new TokenPromo();
                $token_promo->fk_i_company_id = $id;
                $token_promo->i_no_of_tokens = $tokenbalance->i_current_balance;
                $token_promo->fk_i_provided_by = Yii::$app->user->id;
                $token_promo->pk_i_promo_id = 0;
                $token_promo->i_refund_type = 2;
                $token_promo->save();
                //send email of full refund---------------------- 
                //$purchase->f_purchase_amount; to user $purchase->fk_i_user_id
                //send amount to company ------------------------
              // print_r($tokenbalance);
               Yii::$app->session->setFlash('success', 'Amount has fully refunded!!!');
            }else{
                Yii::$app->session->setFlash('danger', 'No token balance available');
            }         
        }else{
            Yii::$app->session->setFlash('danger', 'This user not allowed full refund');

        } 
        return $this->redirect(['tokenmanagement']);
    }
    public function actionPartialrefund($id)
    {
        
        $tokenbalance = TokenBalance::find()->where(['fk_i_user_id' => $id])->one();
        $update = Yii::$app->db->createCommand('UPDATE `token_balance` SET i_prev_balance = "'.$tokenbalance->i_current_balance.'", i_current_balance= 0 WHERE token_balance.fk_i_user_id = '.$id)->execute();
        if($update){
            $token_promo = new TokenPromo();
            $token_promo->fk_i_company_id = $id;
            $token_promo->i_no_of_tokens = $tokenbalance->i_current_balance;
            $token_promo->fk_i_provided_by = Yii::$app->user->id;
            $token_promo->pk_i_promo_id = 0;
            $token_promo->i_refund_type = 1;
            $token_promo->save();
            //send email of partial refund---------------------- 
            //calculate ammount; to user $purchase->fk_i_user_id
            //send amount to company ------------------------
          // print_r($tokenbalance);
           Yii::$app->session->setFlash('success', 'Amount has refunded!!!');
        }else{
            Yii::$app->session->setFlash('danger', 'No token balance available');
        } 
        return $this->redirect(['tokenmanagement']);   
    }
    //Give promotional tokens to company
    public function actionPromotionalToken($id)
    {
        $model = new TokenPromo();
        $model->fk_i_company_id = $id;
        $model->fk_i_provided_by = Yii::$app->user->id;
         if ($model->load(Yii::$app->request->post())) {
              // print_r($_POST['TokenPromo']); die("$$$");
              $promocode = PromoCode::findOne($_POST['TokenPromo']['pk_i_promo_id']);
              $company = TokenBalance::find()->where(['fk_i_user_id' => $_POST['TokenPromo']['fk_i_company_id']])->one();
              $company->i_prev_balance = $company->i_current_balance;
              $company->i_current_balance = $company->i_current_balance + $promocode->i_no_of_tokens;
              $company->save();
              $tokenpromolog = new TokenPromo();
              $tokenpromolog->fk_i_company_id = $_POST['TokenPromo']['fk_i_company_id'];
              $tokenpromolog->i_no_of_tokens = $promocode->i_no_of_tokens;
              $tokenpromolog->fk_i_provided_by = $_POST['TokenPromo']['fk_i_provided_by'];
              $tokenpromolog->pk_i_promo_id = $_POST['TokenPromo']['pk_i_promo_id'];
              if($tokenpromolog->save()){
                //send email functioanlty to caompany for no of tokens added
                Yii::$app->session->setFlash('success', $promocode->i_no_of_tokens.' tokens added');
                return $this->redirect(['tokenmanagement']);   
              }
         }
        return $this->render('tokenpromo', [
            'model' => $model,
        ]);

    
    }
   
}

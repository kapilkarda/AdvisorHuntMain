<?php

namespace backend\controllers;

use Yii;
use backend\models\Campaignphonetext;
use backend\models\CampaignphonetextSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// use backend\models\EmailTemplates;
use backend\models\City;
use backend\models\Zipcode;
use yii\filters\AccessControl;
use backend\models\PhoneTextTemplate;





/**
 * CampaignphonetextController implements the CRUD actions for Campaignphonetext model.
 */
class CampaignphonetextController extends Controller
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
        							'actions' => ['sendcampaign','criteria', 'index', 'create', 'update', 'delete', 'view', 'createcriteria', 'updateemailbody'],
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
     * Lists all Campaignphonetext models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CampaignphonetextSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Campaignphonetext model.
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
     * Creates a new Campaignphonetext model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Campaignphonetext();
        if ($model->load(Yii::$app->request->post())) {
        	$model->dt_deleted_at = null;
        	$model->save();
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
        	return $this->render('create', [
        			'model' => $model,
        	]);
        }
    }

    /**
     * Updates an existing Campaignphonetext model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Campaignphonetext model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Campaignphonetext model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Campaignphonetext the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Campaignphonetext::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSendcampaign($id)
    {
    	$model = $this->findModel($id);





    	$phone_template = PhoneTextTemplate::findOne($model->fk_i_template_id);

        // Below will trigger only when company query is present in "campaign_phone_text" table for a specific campaign.
        if ($model->s_company_query!=="") {
            $company_data = Yii::$app->db->createCommand($model->s_company_query )->queryAll();
            print_r($company_data);

            if(count($company_data) > 0 AND $phone_template->s_template){
                foreach ($company_data as $key => $value) {
                    $companyPhoneNo = Yii::$app->Helpers->lastLoginDateByUserID($value['user_id']);

                    $twilioService = Yii::$app->Yii2Twilio->initTwilio();

                    try {
                        if ($phone_template->i_template_type ==0) {

                            $body = str_replace(
                                array('%%FCOMPANYTNAME%%', '%%EMAIL%%', '%%LAST_LOGIN%%'),
                                array($value['name'], $value['email'], Yii::$app->Helpers->lastLoginDateByUserID($value['user_id'])),
                                $phone_template->s_template
                            );
                            $message = $twilioService->account->messages->create(array(
                                "From" => "+15108337763", // From a valid Twilio number
                                "To" =>'+13027438382', // $companyPhoneNo,  //'+13027438382', //$value['phone'],   // Text this number
                                "Body" => $body,
                            ));
                        }
                        if ($phone_template->i_template_type ==1) {
                            $call = $twilioService->account->calls->create(
                                '+15108337763', // A Twilio number in your account
                                '+13027438382', //$value,// The visitor's phone number
                                'http://advisorhunter.com/a.php'

                            );
                        }


                    } catch (\Services_Twilio_RestException $e) {
    //     				echo $e->getMessage();
                        Yii::$app->getSession()->setFlash('error', $e->getMessage());
                    }
                }
                Yii::$app->getSession()->setFlash('success', 'Messages Sent.');
                return $this->redirect(['index']);
            }
        }

        // Below will trigger only when user query is present in "campaign_phone_text" table for a specific campaign.

        if ($model->s_user_query!=="") {
            $users_data = Yii::$app->db->createCommand($model->s_user_query )->queryAll();
            print_r($users_data);
    
            if(count($users_data) > 0 AND $phone_template->s_template){
                foreach ($users_data as $key => $value) {
                    //echo Yii::$app->Helpers->userAddressByEmail($value['email']);
    //     			$body = str_replace(
    //     					array('%%FULLNAME%%', '%%ADDRESS%%', '%%EMAIL%%', '%%LAST_LOGIN%%', '%%TOKEN_BALANCE%%'),
    //     					array(Yii::$app->Helpers->usersFullNameByEmail($value['email']), Yii::$app->Helpers->userAddressByEmail($value['email']), $value['email'], Yii::$app->Helpers->lastLoginDateByEmail($value['email']), Yii::$app->Helpers->tokenBalanceByEmail($value['email'])),
    //     					$phone_template->s_template
    //     					);
                    //$phone_template->s_template;
                    // Add sms code
                    $twilioService = Yii::$app->Yii2Twilio->initTwilio();

                    try {
                        if ($phone_template->i_template_type ==0) {
                        $phoneNo=Yii::$app->Helpers->PhoneNumberByUserID($value['user_id']);
                        $body = str_replace(
                            array('%%FIRSTNAME%%', '%%LASTNAME%%', '%%EMAIL%%', '%%LAST_LOGIN%%'),
                            array($value['first_name'], $value['last_name'], $value['email'], Yii::$app->Helpers->lastLoginDateByUserID($value['user_id'])),
                            $phone_template->s_template
                        );
                        $message = $twilioService->account->messages->create(array(
                                "From" => "+15108337763", // From a valid Twilio number
                                "To" => $phoneNo, //$value['phone'],  //'+13027438382', //$value['phone'],   // Text this number
                                "Body" => $body,
                        ));
                        }
                        if ($phone_template->i_template_type ==1) {
                            $call = $twilioService->account->calls->create(
                                '+15108337763', // A Twilio number in your account
                                $phoneNo, //$value,// The visitor's phone number
                                'http://advisorhunter.com/a.php'
                            );
                        }

                    } catch (\Services_Twilio_RestException $e) {
    //     				echo $e->getMessage();
                        Yii::$app->getSession()->setFlash('error', $e->getMessage());
                    }
                }
                Yii::$app->getSession()->setFlash('success', 'Messages Sent.');
                return $this->redirect(['index']);
            }
        }
    	else{
    		Yii::$app->getSession()->setFlash('error', 'No Phone Number Found..');
    		return $this->redirect(['index']);
    	}
	
    	
//     			print $message->sid;
    }
    

public function actionCreatecriteria()
{
	if (Yii::$app->request->post()) {
		// return $_POST['critera'];
		if ($_POST['critera'] == "company") {
//			$query = "SELECT DISTINCT `user`.email FROM `user`, `company`, ".(($_POST['last_bidding_days'] != '') ? '`bid` ,':  '')." `payment`, `token_balance`, `background_check`, `company_license` WHERE `user`.id = `company`.user_id ";
            $query = "SELECT DISTINCT `company`.id, `company`.user_id,`company`.name , `company`.email FROM `user`, `company`, ".(($_POST['last_bidding_days'] != '') ? '`bid` ,':  '')." `payment`, `token_balance`, `background_check`, `company_license` WHERE `user`.id = `company`.user_id ";
			if(isset($_POST['company_city']) AND $_POST['company_city'] != ""){
				$city = City::find()
				->where('name = :name', [':name' => $_POST['company_city']])
				->one();
				if(isset($city->id))
					$query .=" AND `company`.city_id=".$city->id;
			}
			if(isset($_POST['company_zip']) AND $_POST['company_zip'] != ""){
				$zip = Zipcode::find()
				->where('zip = :zip', [':zip' =>  $_POST['company_zip']])
				->one();
				if(isset($zip->id))
					$query .=" AND `company`.zip_id=".$zip->id;
			}
			if(isset($_POST['company_state']) AND $_POST['company_state'] != ""){
				$query .=" AND `company`.state_id=".$_POST['company_state'];
			}
			if(isset($_POST['last_bidding_days']) AND $_POST['last_bidding_days'] != ""){
				$query .=" AND `company`.id = `bid`.fk_i_user_id AND DATEDIFF(NOW(), bid.dt_created_at) ".$_POST['last_bidding_days_operator']." ".$_POST['last_bidding_days'];
			}
			if(isset($_POST['last_token_purchase_days']) AND $_POST['last_token_purchase_days'] != ""){
				$query .=" AND `payment`.fk_i_user_id = `company`.id AND DATEDIFF(NOW(), payment.dt_created_at) ".$_POST['last_token_purchase_days_operator']." ".$_POST['last_token_purchase_days'];
			}
			if(isset($_POST['company_token_balance']) AND $_POST['company_token_balance'] != ""){
				$query .=" AND `token_balance`.fk_i_user_id = `company`.id AND token_balance.i_current_balance ".$_POST['company_token_balance_operator']." ".$_POST['company_token_balance'];
			}
			if(isset($_POST['company_closed_account_flag']) AND $_POST['company_closed_account_flag'] != ""){
				$query .=" AND `company`.closed_company_flag = ".$_POST['company_closed_account_flag'];
			}
			if(isset($_POST['company_background_check_pending_flag']) AND $_POST['company_background_check_pending_flag'] != ""){
				$query .=" AND `company`.id NOT IN (SELECT `background_check`.fk_i_company_id FROM background_check) ";
			}
			if(isset($_POST['company_license_data_missing_flag']) AND $_POST['company_license_data_missing_flag'] != ""){
				$query .=" AND `company`.id NOT IN (SELECT `company_license`.fk_i_company_id FROM company_license) ";
			}
			if(isset($_POST['company_registration_status_pending_flag']) AND $_POST['company_registration_status_pending_flag'] != ""){
				$query .=" AND `user`.id NOT IN (SELECT `company`.user_id FROM company) ";
			}
			return \yii\helpers\Json::encode(array('company_query' => $query));
			// $company_emails = \Yii::$app->db->createCommand($query)->queryAll();
			// return \yii\helpers\Json::encode($company_emails);
		}
		// echo "<br>----------------------------------------POST--------------------------------------------<br>";
		// print_r($_POST);
		// echo "<br>--------------------------------------POST END------------------------------------------<br>";
		if ($_POST['critera'] == "user"){
//			$user_query = "SELECT DISTINCT `user_details`.user_id, `user_details`.phone, `user_details`.first_name, `user_details`.last_name, `user_details`.email FROM `user`, `user_details` WHERE `user_details`.phone IS NOT NULL AND LENGTH(`user_details`.phone)>=10 AND `user_details`.dt_deleted_at IS NULL ";
			
			if ( $_POST['user_not_selecting_winner'] != "" OR $_POST['user_last_job_posting_days'] != "")
			{
				$user_query ="SELECT DISTINCT `user_details`.user_id, `user_details`.phone, `user_details`.first_name, `user_details`.last_name, `user_details`.email FROM `user`, `user_details`, `lead` WHERE `user_details`.phone IS NOT NULL AND LENGTH(`user_details`.phone)>=10 AND `user_details`.dt_deleted_at IS NULL ";
			}
			else
            {
                $user_query = "SELECT DISTINCT `user_details`.user_id, `user_details`.phone, `user_details`.first_name, `user_details`.last_name, `user_details`.email FROM `user`, `user_details` WHERE `user_details`.phone IS NOT NULL AND LENGTH(`user_details`.phone)>=10 AND `user_details`.dt_deleted_at IS NULL ";
            }
			
			//if (isset($_POST['user_city'])  != "" AND isset($_POST['user_zip'])  != "" AND isset($_POST['user_state'])  != "" AND isset($_POST['user_last_login_days'])  != "" AND isset($_POST['user_not_selecting_winner'])  != "" AND isset($_POST['user_last_job_posting_days']))
			if ($_POST['user_city'] != "" OR $_POST['user_zip'] != "" OR $_POST['user_state'] != "" OR $_POST['user_last_login_days'] != "" OR $_POST['user_not_selecting_winner'] != "" OR $_POST['user_last_job_posting_days'] != "")
			{
				$user_query .="AND `user`.id =`user_details`.user_id ";
				
				if(isset($_POST['user_city']) AND $_POST['user_city'] != ""){
					$city = City::find()
					->where('name = :name', [':name' => $_POST['user_city']])
					->one();
					if(isset($city->id))
						$user_query .=" `user_details`.city_id=".$city->id;
				}
				if(isset($_POST['user_zip']) AND $_POST['user_zip'] != ""){
					$zip = Zipcode::find()
					->where('zip = :zip', [':zip' =>  $_POST['user_zip']])
					->one();
					if(isset($zip->id))
						$user_query .="  AND `user_details`.zip_id=".$zip->id;
				}
				if(isset($_POST['user_state']) AND $_POST['user_state'] != ""){
					$user_query .=" AND `user_details`.state_id=".$_POST['user_state'];
				}
				if(isset($_POST['user_last_login_days']) AND $_POST['user_last_login_days'] != ""){
						$user_query .=" AND DATEDIFF(NOW(), `user`.last_login_date) ".$_POST['user_last_login_days_operator']." ".$_POST['user_last_login_days'];

				}
// 				// if(isset($_POST['user_registration_status_pending_flag']) AND $_POST['user_registration_status_pending_flag'] != ""){
// 				//     $user_query .=" AND `user`.id NOT IN (SELECT `user_details`.user_id FROM user_details) ";
// 				// }
				if($_POST['user_last_job_posting_days'] != "" OR $_POST['user_not_selecting_winner'] != ""){
					$user_query .=" AND `lead`.fk_i_requested_by = `user`.id group by `lead`.fk_i_requested_by ";
				}
				if(isset($_POST['user_not_selecting_winner']) AND $_POST['user_not_selecting_winner'] != ""){
					$user_query .=" AND `lead`.i_status != having DATEDIFF(NOW(),  max(lead.`dt_date_created`)) ".$_POST['user_not_selecting_winner_operator']." ".$_POST['user_not_selecting_winner'];
				}
				 
				if(isset($_POST['user_last_job_posting_days']) AND $_POST['user_last_job_posting_days'] != ""){
					if(isset($_POST['user_not_selecting_winner']) AND $_POST['user_not_selecting_winner'] != ""){
						$user_query .=" AND ";
					}else{
						$user_query .=" having ";
					}
					$user_query .="  DATEDIFF(NOW(),  max(lead.`dt_date_created`)) ".$_POST['user_last_job_posting_days_operator']." ".$_POST['user_last_job_posting_days'];
				}
			
			}
			return \yii\helpers\Json::encode(array('user_query' => $user_query));
			// $user_emails = Yii::$app->db->createCommand($user_query)->queryAll();
			// return \yii\helpers\Json::encode($user_emails);
		}
		// echo"<br>-----------------------------------EMAILS------------------------------------------------<br>";
		// print_r($user_emails);
		// echo"<br>-------------------------------EMAILS END------------------------------------------------<br>";

		// $model->s_user_query = $user_query;
		// $model->s_company_query = $query;
		// $result = array('user_query' => $user_query,'company_query' => $query);
	}
	else {
		return $this->renderAjax('criteria', []);
	}
}
}

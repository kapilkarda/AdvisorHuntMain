<?php

namespace backend\controllers;

use Yii;
use backend\models\CampaignEmail;
use backend\models\EmailTemplates;
use backend\models\CampaignEmailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\City;
use backend\models\Zipcode;
use yii\filters\AccessControl;

/**
 * CampaignemailController implements the CRUD actions for CampaignEmail model.
 */
class CampaignemailController extends Controller
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
                        'actions' => ['sendcampaignemail','emailcriteria', 'index', 'create', 'update', 'delete', 'view', 'createemailcriteria', 'updateemailbody'],
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
     * Lists all CampaignEmail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CampaignEmailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('dt_deleted_at IS NULL');
            // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $fieledId = Yii::$app->request->post('editableKey');
            // return json_encode(current($_POST['Company'])[$_POST['editableAttribute']]); 
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `campaign_email` SET '.$_POST['editableAttribute'].' = "'.current($_POST['CampaignEmail'])[$_POST['editableAttribute']].'" WHERE campaign_email.pk_i_id = '.$fieledId)->execute();
            // can save model or do something before saving model              
            return json_encode($up);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CampaignEmail model.
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
     * Creates a new CampaignEmail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CampaignEmail();
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
     * Updates an existing CampaignEmail model.
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
     * Deletes an existing CampaignEmail model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         $model = $this->findModel($id);
         $model->dt_deleted_at = date("Y-m-d h:i:s");
         $model->save();
       // $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CampaignEmail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CampaignEmail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CampaignEmail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCreateemailcriteria()
    {
        if (Yii::$app->request->post()) {
            
            // echo "<br>----------------------------------------POST--------------------------------------------<br>";
            // print_r($_POST);
            // echo "<br>--------------------------------------POST END------------------------------------------<br>";

            $query = "SELECT DISTINCT `user`.email FROM `user`, `company`, `bid`, `payment`, `token_balance`, `background_check`, `company_license` WHERE `user`.id = `company`.user_id ";
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
            $company_emails = Yii::$app->db->createCommand($query)->queryAll();
            
            $user_query = "SELECT DISTINCT `user`.email FROM `user`, `user_details`, `lead` WHERE `user`.id = `user_details`.user_id";
            if(isset($_POST['user_city']) AND $_POST['user_city'] != ""){
                $city = City::find()
                    ->where('name = :name', [':name' => $_POST['user_city']])
                    ->one(); 
                if(isset($city->id))
                    $user_query .=" AND `user_details`.city_id=".$city->id;
            }
            if(isset($_POST['user_zip']) AND $_POST['user_zip'] != ""){
                $zip = Zipcode::find()
                    ->where('zip = :zip', [':zip' =>  $_POST['user_zip']])
                    ->one();
                if(isset($zip->id))
                    $user_query .=" AND `user_details`.zip_id=".$zip->id;
            }
            if(isset($_POST['user_state']) AND $_POST['user_state'] != ""){
                $user_query .=" AND `user_details`.state_id=".$_POST['user_state'];
            }
            if(isset($_POST['user_last_login_days']) AND $_POST['user_last_login_days'] != ""){
                $user_query .=" AND DATEDIFF(NOW(), user.last_login_date) ".$_POST['user_last_login_days_operator']." ".$_POST['user_last_login_days'];
            }
            // if(isset($_POST['user_registration_status_pending_flag']) AND $_POST['user_registration_status_pending_flag'] != ""){
            //     $user_query .=" AND `user`.id NOT IN (SELECT `user_details`.user_id FROM user_details) ";
            // }
            if($_POST['user_last_job_posting_days'] != "" OR $_POST['user_not_selecting_winner'] != ""){
                $user_query .=" AND lead.fk_i_requested_by = user.id group by lead.fk_i_requested_by ";
            }
            if(isset($_POST['user_not_selecting_winner']) AND $_POST['user_not_selecting_winner'] != ""){
                $user_query .=" AND lead.i_status != 3 having DATEDIFF(NOW(),  max(lead.`dt_date_created`)) ".$_POST['user_not_selecting_winner_operator']." ".$_POST['user_not_selecting_winner'];
            }
           
            if(isset($_POST['user_last_job_posting_days']) AND $_POST['user_last_job_posting_days'] != ""){
                if(isset($_POST['user_not_selecting_winner']) AND $_POST['user_not_selecting_winner'] != ""){
                    $user_query .=" AND ";
                }else{
                    $user_query .=" having ";
                }         
                $user_query .="  DATEDIFF(NOW(),  max(lead.`dt_date_created`)) ".$_POST['user_last_job_posting_days_operator']." ".$_POST['user_last_job_posting_days'];
            }
                 
            $user_emails = Yii::$app->db->createCommand($user_query)->queryAll();
            
            // echo"<br>-----------------------------------EMAILS------------------------------------------------<br>";
            // print_r($user_emails);
            // echo"<br>-------------------------------EMAILS END------------------------------------------------<br>";
            // echo $user_query."<br>";
            // echo $query;

            // $model = $this->findModel($_POST['id']);

            // $model->s_user_query = $user_query;
            // $model->s_company_query = $query;
            $result = array('user_query' => $user_query,'company_query' => $query);
            return \yii\helpers\Json::encode($result);
        }   
        else {
            return $this->renderAjax('emailcriteria', []);
        }
    }

    public function actionSendcampaignemail($id)
    {
        $model = $this->findModel($id);
        $emails = Yii::$app->db->createCommand($model->s_user_query.' UNION '.$model->s_company_query )->queryAll();
        print_r($emails);
        $email_template = EmailTemplates::findOne($model->fk_i_template_id);
  
        if(count($emails) > 0 AND $email_template->s_email_template){
            foreach ($emails as $key => $value) {
               echo Yii::$app->Helpers->userAddressByEmail($value['email']); 
               $body = str_replace(
                  array('%%FULLNAME%%', '%%ADDRESS%%', '%%EMAIL%%', '%%LAST_LOGIN%%', '%%TOKEN_BALANCE%%'), 
                  array(Yii::$app->Helpers->usersFullNameByEmail($value['email']), Yii::$app->Helpers->userAddressByEmail($value['email']), $value['email'], Yii::$app->Helpers->lastLoginDateByEmail($value['email']), Yii::$app->Helpers->tokenBalanceByEmail($value['email'])), 
                  $email_template->s_email_template
                );
               Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['adminEmail'])
                    // ->setTo('sachin.chavan@cityit.in')
                    ->setTo($value['email'])
                    ->setSubject('Campaign Email')
                    ->setHtmlBody($body)
                    ->send();         
            }
            Yii::$app->getSession()->setFlash('success', 'Emails Sent.');
                    return $this->redirect(['index']);
        }
        else{
            Yii::$app->getSession()->setFlash('error', 'No emails Found..');
                return $this->redirect(['index']);
        }
    }

}

<?php

namespace api\modules\v1\controllers;

use Yii;
// use \common\models\LoginForm;

// use frontend\models\ContactForm;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\rest\Controller;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use \webvimark\modules\UserManagement\models\User;
use \webvimark\modules\UserManagement\components\UserAuthEvent;
use \api\modules\v1\models\LoginForm;
use \api\modules\v1\models\RegistrationForm;
use \api\modules\v1\models\UserDetails;
use \api\modules\v1\models\Company;
use \api\modules\v1\models\Zipcode;
use \api\modules\v1\models\CompanyReviewComment;
use \api\modules\v1\models\CompanyRating;
/**
 * Site controller
 */
class ApiController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className(),
//            'only' => ['dashboard'],
//        ];
        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::className(),
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'only' => ['dashboard'],
            'rules' => [
                [
                    'actions' => ['dashboard'],
                    'allow' => true,
                    'roles' => ['@'],
                ],
            ],
        ];
        return $behaviors;
    }

    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
            if(User::hasRole(['Customer']))
            {
                $role = 'Customer';
                // $userModel = new UserDetails;
                $user_id = \Yii::$app->user->identity->id;
                $userDetails = UserDetails::find()
                    ->where(['=', "user_id", $user_id])
                    ->andWhere(['IS','dt_deleted_at',null])
                    ->one();
            }
            if(User::hasRole(['Provider'])){
                $role = 'Provider';
                $user =  \Yii::$app->user->identity->id;
                $userDetails = Company::find()
                    ->where(['=', "user_id", $user])
                    ->andWhere(['IS','dt_deleted_at',null])
                    // ->andWhere(['=','active_company_flag',1])
                    // ->andWhere(['=','closed_company_flag',0])
                    ->one();
                    
            }
            return $response = [
                'status' => 1,
                'userdetails' => $userDetails,
                'role' => $role,
                'email' => \Yii::$app->user->identity->email,
                'access_token' => \Yii::$app->user->identity->getAuthKey(),
            ];
           
        } else {
            $model->validate();
            return $model;
        }
    }

    public function actionSignup()
    {
        $model = new RegistrationForm();

        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') && $model->registerUser())
        {              
            return '1';

        }else{
             $model->validate();
            return $model;
        }
    }

    public function actionProSignup()
    {
        $model = new RegistrationForm();
        $loginModel = new LoginForm();
        // print($_SERVER['REMOTE_ADDR']);
// print_r(Yii::$app->getRequest()->getBodyParam('email'));die("ddddddddd");
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), ''))
        {
            if($model->registerPro()){
                    if($loginModel->load(\Yii::$app->getRequest()->getBodyParams(), '') && $loginModel->loginpro()){
            
                        return $response = [
                            'status' => 1,
                            'user_id' => \Yii::$app->user->identity->id,
                            'role' => 'Provider',
                            'email' => \Yii::$app->user->identity->email,
                            'access_token' => \Yii::$app->user->identity->getAuthKey(),
                        ];
                    }else{
                        return $response = [
                            'status' => 0,
                        ];
                    }
            }else{
                $model->validate();
                return $model;
            }
        }else{
            $model->validate();
            return $model;
        }
    }

    public function actionProByZip()
    {
       if($_GET['zipcode'])
        {   
            $zip = Zipcode::find()
                ->where(['=', "zip", $_GET['zipcode']])
                ->andWhere(['IS','dt_deleted_at',null])
                ->one();             
            if($zip){
                $pro = Company::find()
                    ->where(['=', "zip_id", $zip->id])
                    ->andWhere(['IS','dt_deleted_at',null])
                    // ->andWhere(['=','active_company_flag',1]) //uncomment 2 lines for final touch
                    // ->andWhere(['=','closed_company_flag',0]);
                    ->all();  
                return $pro;
            }
            else{
                return 0;
            }           
        }else{
             
            return 0;
        }
    }

    public function actionAddReview()
    {
        $model = new CompanyReviewComment();
        $user_id =  \Yii::$app->user->identity->id;
        return $user_id;
        if ($model->load(\Yii::$app->getRequest()->getBodyParams(), '') )
        {
            print_r($model);
            die(Yes);

            if($model->save())
                return 1;
            else{
                return 0;
            }
        }else{
            $model->validate();
            return $model;
        }
    }
 
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->validate()) {
    //         if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
    //             $response = [
    //                 'flash' => [
    //                     'class' => 'success',
    //                     'message' => 'Thank you for contacting us. We will respond to you as soon as possible.',
    //                 ]
    //             ];
    //         } else {
    //             $response = [
    //                 'flash' => [
    //                     'class' => 'error',
    //                     'message' => 'There was an error sending email.',
    //                 ]
    //             ];
    //         }
    //         return $response;
    //     } else {
    //         $model->validate();
    //         return $model;
    //     }
    // }
    
}
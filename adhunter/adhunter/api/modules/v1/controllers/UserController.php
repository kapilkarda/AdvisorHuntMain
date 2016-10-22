<?php

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;
class UserController extends ActiveController
{
    public $modelClass = 'app\models\User';


	public function behaviors()
	{
	    $behaviors = parent::behaviors();
//	    $behaviors['authenticator'] = [
//	        'class' => HttpBearerAuth::className(),
//	    ];
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
	    return $behaviors;
	}


//	public function actionLogin()
//	{
//		return "HI";
//
//	}
}
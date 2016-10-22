<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use \api\modules\v1\models\CompanyLicense;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;


/**
 * CompanylicenseController API
 *
 */
class CompanylicenseController  extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\CompanyLicense';

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

	    return $actions;
	}
	
	public function actionDelete($id)
    {
       	$model = CompanyLicense::findone($id);
        $model->dt_deleted_at = date("Y-m-d h:i:s");
        if($model->save())
        	return 1;
    }
}



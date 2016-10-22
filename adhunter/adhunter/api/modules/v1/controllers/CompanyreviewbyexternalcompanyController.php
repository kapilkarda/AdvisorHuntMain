<?php
namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;


/**
 * CompanyreviewbyexternalcompanyController API
 *
 */
class CompanyreviewbyexternalcompanyController  extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\CompanyReviewByExternalCompany';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className(),
//        ];
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
}


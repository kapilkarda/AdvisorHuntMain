<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;

/**
 * ZipcodeController API
 *
 */
class ZipcodeController  extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Zipcode';

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

	    // disable the "delete" and "create" actions
	    unset($actions['delete'], $actions['create'], $actions['update']);

	    // customize the data provider preparation with the "prepareDataProvider()" method
	   // $actions['view']['prepareDataProvider'] = [$this, 'customview'];
	    // echo"<pre>";print_r($actions['test']);echo"<pre>";die("@@@");

	    return $actions;
	}

	public function actionLocationByZipcode($zipcode)
	{
		$location = \Yii::$app->db->createCommand('SELECT z.id, z.zip, z.latitude, z.longitude, ct.id as city_id, ct.name as city_name, s.id as state_id, s.name as state_name, s.short_name as state_short_name, cn.id as country_id, cn.name as country_name
													FROM zipcode as z, city as ct, state as s, country as cn 
													WHERE z.city_id = ct.id AND ct.state_id = s.id AND s.country_id = cn.id AND z.dt_deleted_at IS NULL AND z.zip ='.$zipcode)->queryAll();
		if($location)
				return $location;
		else
				return 0;
	}
	public function actionLocationByZipid($zipid)
	{
		$location = \Yii::$app->db->createCommand('SELECT z.id, z.zip, z.latitude, z.longitude,  ct.name as city_name, s.name as state_name, s.short_name as state_short_name, cn.name as country_name
													FROM zipcode as z, city as ct, state as s, country as cn 
													WHERE z.city_id = ct.id AND ct.state_id = s.id AND s.country_id = cn.id AND z.dt_deleted_at IS NULL AND z.id ='.$zipid)->queryAll();
		if($location)
				return $location;
		else
				return 0;
	}
}

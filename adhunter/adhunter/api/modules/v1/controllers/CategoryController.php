<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;


/**
 * CategoryController API
 *
 */
class CategoryController  extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Category';

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
	    $actions['index']['prepareDataProvider'] = [$this, 'customindex'];
	    // echo"<pre>";print_r($actions['test']);echo"<pre>";die("@@@");

	    return $actions;
	}

	public function customindex(){
		$category = \Yii::$app->db->createCommand('SELECT c.id, c.name, c.image  FROM category as c WHERE c.b_front_page = 1 AND c.dt_deleted_at IS NULL')->queryAll();
		if($category)
			return $category;
				// return json_encode($subcategory);
		else
				return 0;
	}

	public function actionGetSubcategoryByCategory($catid){

		$subcategory = \Yii::$app->db->createCommand('SELECT s.id, s.name, s.s_image, s.category_id FROM subcategory as s WHERE s.category_id='.$catid.' AND s.dt_deleted_at IS NULL')->queryAll();
		if($subcategory)
			return $subcategory;
		else
				return 0;
	} 
}

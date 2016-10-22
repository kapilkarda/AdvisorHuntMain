<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Session;
use \api\modules\v1\models\Question;
use \api\modules\v1\models\Answer;
use yii\filters\auth\HttpBearerAuth;
use yii\web\Response;


/**
 * BackgroundcheckController API
 *
 */
class SubcategoryController  extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Subcategory';      

	 public function behaviors()
	 {
	     $behaviors = parent::behaviors();
//	     $behaviors['authenticator'] = [
//	         'class' => HttpBearerAuth::className(),
//	     ];
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

	public function actionHomeList($q)
	{ 
		$subcategory = \Yii::$app->db->createCommand("SELECT s.id, s.name, s.s_image, s.category_id FROM subcategory as s WHERE s.name LIKE '%".$q."%' AND s.dt_deleted_at IS NULL")->queryAll();
		if($subcategory)
			return $subcategory;
				// return json_encode($subcategory);
		else
				return 0;		
	}

	public function customindex(){
		$subcategory = \Yii::$app->db->createCommand('SELECT s.id, s.name, s.s_image, s.category_id FROM subcategory as s WHERE s.dt_deleted_at IS NULL')->queryAll();
		if($subcategory)
			return $subcategory;
				// return json_encode($subcategory);
		else
				return 0;
	}

	public function actionQuestionsByCategory($categoryid)
	{
		// $model = Question::find()
		//     ->where('userid > :userid', [':userid' => $userid])
		//     ->one();
		$question = \Yii::$app->db->createCommand('SELECT q.id, q.question_text, q.question_type_id FROM question as q, question_category as qc  WHERE q.id = qc.question_id AND q.dt_deleted_at IS NULL AND qc.subcategory_id = '.$categoryid.'')->queryAll();
		if($question)
				return json_encode($question);
		else
				return 0;
				# code...
			
		// print_r($question);
		// die("ss");
		// $options = \Yii::$app->db->createCommand('SELECT o.answer_text, q.question_type_id FROM option as qc  WHERE q.id = qc.question_id AND qc.subcategory_id = '.$categoryid.'')->queryAll();

	}
	public function actionOptionsByQuestion($questionid)
	{
		$options = \Yii::$app->db->createCommand('SELECT o.id, o.question_id, o.answer_text, o.dependent_question_id FROM `option` as o WHERE o.dt_deleted_at IS NULL AND o.question_id = '.$questionid)->queryAll();
		if($options)
			return json_encode($options);
		else{
			return 0;
		}
				
	}

}

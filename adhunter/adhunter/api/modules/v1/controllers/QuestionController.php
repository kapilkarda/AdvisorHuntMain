<?php

namespace api\modules\v1\controllers;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBearerAuth;
use backend\models\Question;
//use yii\data\ActiveDataProvider;
//use yii\web\Controller;
//use yii\web\NotFoundHttpException;
use yii\web\Response;
/**
 * QuestionController API
 *
 */
class QuestionController  extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Question';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => HttpBearerAuth::className(),
//        ];
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }
    
    public function actionCategory()
    {
	die("######");     
 
    // $model = $this->findModel($id);echo $id;die("######");
   //  $question = Question::find()->where(['id' => $id])->one();
   //  return new ActiveDataProvider([
   //     'query' => $question::find($id),
   // ]);
        //print_r($question);die("########");
	//die("##########");
    }
}

 
<?php

namespace backend\controllers;

use Yii;
use backend\models\Question;
use backend\models\QuestionSearch;
use backend\models\Answer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
    public function behaviors()
    {
        return [
	    'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['index', 'create', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'detach'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$searchModel = new QuestionSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => Question::find()->with('subcategory'),
        ]);
         //$dataProvider->query->where('dt_deleted_at IS NULL'); //Commented by Aninda 6/5
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);  //Modified by Aninda 6/5
        return $this->render('index', [
        	'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
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
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        $model = new Question();
        $answermodel = new Answer();
         if ($model->load(Yii::$app->request->post())) {
            	$model->dt_deleted_at = null;
            	$model->save();
          }
        // if(isset($_POST)){
        //     echo count($_POST['Answer']['answer_text']);
        //      echo"<pre>";print_r($_POST);echo"</pre>";die("KKKKKKKKK");
        // }
        if ($model->load(Yii::$app->request->post()) && $model->save()) { 
            $question_id = $model->id;
            if(isset($_POST['subcategory_id'])){                
                foreach ($_POST['subcategory_id'] as $key => $value) {
                    Yii::$app->db->createCommand('INSERT INTO `question_category` (`question_id`, `subcategory_id`) VALUES (:question,:subcategroy)', [
                        ':question' => $question_id,':subcategroy' => $value
                    ])->execute();
                }
            }
            // print_r($_POST);die();
            if($_POST['answer_text'][0] !=''){
                // echo"<pre>";print_r($_POST);echo"</pre>";die("AAAAAA");
                 foreach ($_POST['answer_text'] as $answer) {
                    if(trim($answer) != ''){
                        // echo $answer; echo $question_id;
                        $new_answer = new Answer();
                        $new_answer->question_id = $question_id;
                        $new_answer->answer_text = $answer;
                        $new_answer->save();
                    }                    
                }
            }
            if(isset($_POST['option_id'])){
                 $option = Answer::find()->where(['id' => $_POST['option_id']])->one();
                 $option->dependent_question_id = $question_id;
                 $option->update();

            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model, 'answermodel' => $answermodel,
            ]);
        }
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        
        $model = Question::find()->with('answers')->with('subcategory')->where(['id' => $id])->one();
        $answermodel = new Answer();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // print_r($_POST['answer_text']); echo "<br>========================"; print_r($_POST); die();                      
            $question_id = $model->id;
            if(isset($_POST['subcategory_id'])){
                Yii::$app->db->createCommand()->delete('question_category', ['question_id' => $question_id])->execute();
                foreach ($_POST['subcategory_id'] as $key => $value) {
                    Yii::$app->db->createCommand('INSERT INTO `question_category` (`question_id`, `subcategory_id`) VALUES (:question,:subcategroy)', [
                        ':question' => $question_id,':subcategroy' => $value
                    ])->execute();
                }
                
                $model->updated_at =date("Y-m-d h:i:s"); //Added by Aninda on 6/4
            	$model->save();
            }

            // $model = $this->findModel($id);
         if(isset($_POST['answer_text'][0])){
            Yii::$app->db->createCommand('DELETE FROM `option` WHERE question_id = :question', [
                        ':question' => $question_id])->execute();
                // echo"<pre>";print_r($_POST);echo"</pre>";die("AAAAAA");
                if($_POST['Question']['question_type_id'] != 3){

                    if($_POST['Question']['question_type_id'] == 5){
                        foreach ($_POST['dates'] as $answer) {
                            if(trim($answer) != ''){
                                $new_answer = new Answer();
                                $new_answer->question_id = $question_id;
                                $new_answer->answer_text = $answer;
                                $new_answer->save();
                            }                    
                        }
                    }
                    else{
                         foreach ($_POST['answer_text'] as $answer) {
                            if(trim($answer) != ''){
                                $new_answer = new Answer();
                                $new_answer->question_id = $question_id;
                                $new_answer->answer_text = $answer;
                                $new_answer->save();
                            }                    
                        }
                    }                 
                }
                
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model, 'answermodel' => $answermodel,
            ]);
        }
    }

    /**
     * Detach an existing Question from option
     */
    public function actionDetach()
    {
        $option = Answer::find()->where(['id' => $_GET['option_id']])->one();
        $option->dependent_question_id = null;
        $option->update();
        return $this->redirect(Yii::$app->getUrlManager()->getBaseUrl().'/index.php?r=question/view&id='.$option['question_id']);
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         $model = $this->findModel($id);
         $model->dt_deleted_at = date("Y-m-d h:i:s");
         $model->save();
        //$this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

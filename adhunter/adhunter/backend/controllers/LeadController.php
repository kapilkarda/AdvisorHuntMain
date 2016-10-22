<?php

namespace backend\controllers;

use Yii;
use backend\models\Lead;
use backend\models\LeadSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\City;
use backend\models\Zipcode;
use yii\filters\AccessControl;

/**
 * LeadController implements the CRUD actions for Lead model.
 */
class LeadController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'statuschange'],
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
     * Lists all Lead models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LeadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
          // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $projId = Yii::$app->request->post('editableKey');
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `lead` SET '.$_POST['editableAttribute'].' = "'.current($_POST['Lead'])[$_POST['editableAttribute']].'" WHERE lead.pk_i_id = '.$projId)->execute();
            // can save model or do something before saving model                         
            return json_encode($up);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lead model.
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
     * Creates a new Lead model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lead();
    //echo "<pre>";print_r( $model); echo "</pre>";die("#########");
       	if ($model->load(Yii::$app->request->post())){
          
                    $model->dt_request_renew_date = $_POST['dt_request_renew_date'];
	            $model->dt_request_complete_date = $_POST['dt_request_complete_date'];
                    
       		    $model->attributes=$_POST['Lead'];
		  
	            $city = City::find()
                   ->where('name = :name', [':name' => $_POST['Lead']['city']])
                   ->one();                 

                    if(isset($city->id)){
                          $model->fk_i_city_id = $city->id;
                    }                      
                    else{
                        $model->addError('city', "Invalid City name
                            ");
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
               
                 
                  $zip = Zipcode::find()
                    ->where('zip = :zip', [':zip' =>  $_POST['Lead']['zip']])
                    ->one();
		   
		  //$test =  $model->fk_i_zip_id = $zip->id;
		    //if($model->fk_i_zip_id != $test){
                    if(isset($zip->id)){
                        $model->fk_i_zip_id = $zip->id;
                    }                   
                    else{
                        $model->addError('zip', "Invalid Zip");
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
	           
	            $model->dt_deleted_at = null;
                  $model->save();
                 return $this->redirect(['view', 'id' => $model->pk_i_id]);
	             //if($model->save()){
	            //    return $this->redirect(['view', 'id' => $model->pk_i_id]);
	            //}
           
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Lead model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
           if($model->dt_request_renew_date && $model->dt_request_complete_date)
           {
             if($model->dt_request_renew_date && $model->dt_request_complete_date!==null)
             {
                $model->attributes=$_POST['Lead'];
                $model->dt_request_renew_date = $_POST['dt_request_renew_date'];
                $model->dt_request_complete_date = $_POST['dt_request_complete_date'];
                $model->save();
		
                $city = City::find()
                ->where('name = :name', [':name' => $_POST['Lead']['city']])
                ->one();
                 $model->attributes=$_POST['Lead'];
                 $model->fk_i_city_id = $city->id;
                 
                  $zip = Zipcode::find()
                ->where('zip = :zip', [':zip' =>  $_POST['Lead']['zip']])
                ->one();
                 $model->fk_i_zip_id = $zip->id;
             
             }
           } 
          }
          $model->save();
          //$model->dt_request_complete_date = $_POST['dt_request_complete_date'];
         
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lead model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    
    {
        //$model = $this->findModel($id);
        //$model->dt_deleted_at = date("Y-m-d h:i:s");
        // $model->save();
        //$this->findModel($id)->delete();
         
    	Yii::$app->db->createCommand('UPDATE `lead` SET dt_deleted_at = "'.date("Y-m-d h:i:s").'" WHERE lead.pk_i_id = '.$id)->execute();
        return $this->redirect(['index']);
       
    }

    /**
     * Finds the Lead model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Lead the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lead::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionStatuschange()
    { 
        if (Yii::$app->request->post()) {
            $model = $this->findModel($_POST['lead_id']);
            $model->i_status = $_POST['status'];
            if($model->save())
                return 1;
            else
                return 0;
        } 
    }
}

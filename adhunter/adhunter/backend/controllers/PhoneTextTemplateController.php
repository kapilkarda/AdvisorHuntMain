<?php

namespace backend\controllers;

use Yii;
use backend\models\PhoneTextTemplate;
use backend\models\PhoneTextTemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PhoneTextTemplateController implements the CRUD actions for PhoneTextTemplate model.
 */
class PhoneTextTemplateController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all PhoneTextTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhoneTextTemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhoneTextTemplate model.
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
     * Creates a new PhoneTextTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhoneTextTemplate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
        	
        	// Get the instance of the uploaded file
	        	$fileName = $model->pk_i_id;
	        	$model->file =UploadedFile::getInstance($model, 'file');
	        	if ($model->file!==null)
	        	{
	        	
		        	$model -> file ->saveAs('uploads/'.$fileName . '.' . $model->file->extension);
		        	
		        	//Save the path in DB. 
		        	
		        	$model -> s_template = 'uploads/'. $model->pk_i_id . '.' . $model->file->extension;
		        	$model->save();
        		}
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PhoneTextTemplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
        	// Get the instance of the uploaded file
        	$fileName = $model->pk_i_id;
        	$model->file =UploadedFile::getInstance($model, 'file');
        	if ($model->file!==null)
        	{
        	
        		$model -> file ->saveAs('uploads/'.$fileName . '.' . $model->file->extension);
        		 
        		//Save the path in DB.
        		 
        		$model -> s_template = 'uploads/'. $model->pk_i_id . '.' . $model->file->extension;
        		$model->save();
        	}
        	
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PhoneTextTemplate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PhoneTextTemplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhoneTextTemplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhoneTextTemplate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

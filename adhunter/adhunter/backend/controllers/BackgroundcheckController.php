<?php

namespace backend\controllers;

use Yii;
use backend\models\BackgroundCheck;
use backend\models\BackgroundCheckSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\imagine\Image;


/**
 * BackgroundCheckController implements the CRUD actions for BackgroundCheck model.
 */
class BackgroundcheckController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
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
     * Lists all BackgroundCheck models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BackgroundCheckSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BackgroundCheck model.
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
     * Creates a new BackgroundCheck model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BackgroundCheck();
        if(isset($_GET['company_id'])){
            $model->fk_i_company_id = $_GET['company_id'];
        }

         if ($model->load(Yii::$app->request->post())) {
               if($model->dt_bg_check_date)
               {
                    $model->attributes=$_POST['BackgroundCheck'];
                    $model->dt_bg_check_date = $_POST['dt_bg_check_date'];
                    $model->s_bg_check_validity = $_POST['s_bg_check_validity'];
               }
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->attributes=$_POST['BackgroundCheck'];
            $model->dt_bg_check_date = $_POST['dt_bg_check_date'];
            $model->s_bg_check_validity = $_POST['s_bg_check_validity'];
            $model->dt_deleted_at = null;
            	
            if($model->save()){
                $model->imagei = UploadedFile::getInstance($model,'imagei');
                if(isset($model->imagei)){

                    $imageName = 'back_check_image'.'_'.$model->pk_i_id.'.'.$model->imagei->extension;                      
                    $localImagePath = 'uploads/back_check_image/'.$imageName;
                    $localImageThumbPath = 'uploads/back_check_image/thumbs/'.$imageName;
                    $localImageMidsizeThumbPath = 'uploads/back_check_image/thumbs/midsize/'.$imageName;
                
                    $model->imagei->saveAs($localImagePath);
                    Image::thumbnail( $localImagePath, 100, 100)
                        ->save($localImageThumbPath, ['quality' => 50]);
                    Image::thumbnail( $localImagePath, 250, 186)
                        ->save($localImageMidsizeThumbPath, ['quality' => 50]);

                    Yii::$app->Helpers->uploadToS3($localImagePath, 'back_check_image/'.$imageName);  
                    Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'back_check_image/thumbs/'.$imageName);                           
                    Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'back_check_image/thumbs/midsize/'.$imageName);                           
                    
                    $model->s_bg_check_report_image = $imageName;
                    $model->save();
                    unlink($localImagePath);
                    unlink($localImageThumbPath);
                    unlink($localImageMidsizeThumbPath);
                }  
               return 1;
            }
            else{
                return 0;
            }
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BackgroundCheck model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post())) {
               if($model->dt_bg_check_date)
               {
                    $model->attributes=$_POST['BackgroundCheck'];
                    $model->dt_bg_check_date = $_POST['dt_bg_check_date'];
                    $model->s_bg_check_validity = $_POST['s_bg_check_validity'];
               }
        }
        if($model->save()){
            $model->imagei = UploadedFile::getInstance($model,'imagei');
            if($model->imagei){

                    $imageName = 'back_check_image'.'_'.$model->pk_i_id.'.'.$model->imagei->extension;
                        
                    $localImagePath = 'uploads/back_check_image/'.$imageName;
                    $localImageThumbPath = 'uploads/back_check_image/thumbs/'.$imageName;
                    $localImageMidsizeThumbPath = 'uploads/back_check_image/thumbs/midsize/'.$imageName;
                
                    $model->imagei->saveAs($localImagePath);
                    Image::thumbnail( $localImagePath, 100, 100)
                        ->save($localImageThumbPath, ['quality' => 50]);
                    Image::thumbnail( $localImagePath, 250, 186)
                        ->save($localImageMidsizeThumbPath, ['quality' => 50]);

                    Yii::$app->Helpers->uploadToS3($localImagePath, 'back_check_image/'.$imageName);  
                    Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'back_check_image/thumbs/'.$imageName);                           
                    Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'back_check_image/thumbs/midsize/'.$imageName);                           
                    
                    $model->s_bg_check_report_image = $imageName;
                    $model->save();
                    unlink($localImagePath);
                    unlink($localImageThumbPath);
                    unlink($localImageMidsizeThumbPath);
                }  
          }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BackgroundCheck model.
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
     * Finds the BackgroundCheck model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BackgroundCheck the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BackgroundCheck::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

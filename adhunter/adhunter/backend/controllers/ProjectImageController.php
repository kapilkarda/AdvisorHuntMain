<?php

namespace backend\controllers;

use Yii;
use backend\models\ProjectImage;
use backend\models\ProjectImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * ProjectImageController implements the CRUD actions for projectimage model.
 */
class ProjectImageController extends Controller
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
     * Lists all projectimage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            
            // instantiate your book model for saving
            $projId = Yii::$app->request->post('editableKey');
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `project_image` SET '.$_POST['editableAttribute'].' = "'.current($_POST['ProjectImage'])[$_POST['editableAttribute']].'" WHERE project_image.pk_i_id = '.$projId)->execute();
            // can save model or do something before saving model                         
            return json_encode($up);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single projectimage model.
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
     * Creates a new projectimage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProjectImage();

       if ($model->load(Yii::$app->request->post())) {
                $model->dt_deleted_at = null;
                $model->save();
                    $model->file = UploadedFile::getInstance($model,'file');
            //$imageName = Yii::$app->security->generateRandomString();
            if(!empty($model->file)){
                
                $imageName = 'project_image'.'_'.$model->pk_i_id.'.'.$model->file->extension;
                $localImagePath = 'uploads/project_image/'.$imageName;
                $localImageThumbPath = 'uploads/project_image/thumbs/'.$imageName;
                $localImageMidsizeThumbPath = 'uploads/project_image/thumbs/midsize/'.$imageName;

                $model->file->saveAs($localImagePath);
                Image::thumbnail( $localImagePath, 100, 100)
                    ->save($localImageThumbPath, ['quality' => 50]);
                Image::thumbnail( $localImagePath, 250, 186)
                    ->save($localImageMidsizeThumbPath, ['quality' => 50]);

                Yii::$app->Helpers->uploadToS3($localImagePath, 'project_image/'.$imageName);  
                Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'project_image/thumbs/'.$imageName);                           
                Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'project_image/thumbs/midsize/'.$imageName);                           
                
                $model->s_image = $imageName;
                $model->save(); 
               unlink($localImagePath);
               unlink($localImageThumbPath);
               unlink($localImageMidsizeThumbPath);
            }
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
          }  else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing projectimage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
                  
         $model->file = UploadedFile::getInstance($model, 'file');
          if ($model->save())        
           {            
              if($model->file!==null)
                {    $imageName = 'project_image'.'_'.$model->pk_i_id.'.'.$model->file->extension;
                
                    $localImagePath = 'uploads/project_image/'.$imageName;
                    $localImageThumbPath = 'uploads/project_image/thumbs/'.$imageName;
                     $localImageMidsizeThumbPath = 'uploads/project_image/thumbs/midsize/'.$imageName;

                    $model->file->saveAs($localImagePath);
                    Image::thumbnail( $localImagePath, 100, 100)
                        ->save($localImageThumbPath, ['quality' => 50]);
                        Image::thumbnail( $localImagePath, 250, 186)
                    ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                    Yii::$app->Helpers->uploadToS3($localImagePath, 'project_image/'.$imageName);  
                    Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'project_image/thumbs/'.$imageName);     
                    Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'project_image/thumbs/midsize/'.$imageName);                           
                    $model->s_image = $imageName;
                    $model->save(); 
                    unlink($localImagePath);
                    unlink($localImageThumbPath);
                    unlink($localImageMidsizeThumbPath);
                }
           
           }
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing projectimage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
         $model = $this->findModel($id);
         $model->dt_deleted_at = date("Y-m-d h:i:s");
         $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the projectimage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return projectimage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = projectimage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
        //activate bulk images
    public function actionActivate()
    {
         if (Yii::$app->request->post()) {
            print_r($_POST['records']);
            print_r(explode(",", $_POST['records']));

            projectimage::updateAll(['b_status' => 1], ['in', 'pk_i_id', explode(',', $_POST['records'])]);
          }
        return $this->redirect(['index']);
    }

      //activate bulk images
    public function actionDeactivate()
    {
         if (Yii::$app->request->post()) {
            print_r($_POST['records']);
            print_r(explode(",", $_POST['records']));

            projectimage::updateAll(['b_status' => 0], ['in', 'pk_i_id', explode(',', $_POST['records'])]);
          }
        return $this->redirect(['index']);
    }
}

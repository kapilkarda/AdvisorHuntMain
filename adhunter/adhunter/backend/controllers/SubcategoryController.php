<?php

namespace backend\controllers;

use Yii;
use backend\models\Subcategory;
use backend\models\SubcategorySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\imagine\Image;
/**
 * SubcategoryController implements the CRUD actions for Subcategory model.
 */
class SubcategoryController extends Controller
{
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
                    'delete' => ['post'],
                ],
            ],
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * Lists all Subcategory models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$searchModel = new SubcategorySearch();
//         $dataProvider = new ActiveDataProvider([
//             'query' => Subcategory::find()->with('category'),
//         ]);
//         $dataProvider->query->where('dt_deleted_at IS NULL');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);  //Modified by Aninda 6/5
         if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $catId = Yii::$app->request->post('editableKey');
            $up = Yii::$app->db->createCommand('UPDATE `subcategory` SET '.$_POST['editableAttribute'].' = "'.current($_POST['Subcategory'])[$_POST['editableAttribute']].'" WHERE subcategory.id = '.$catId)->execute();
            // can save model or do something before saving model      
            return json_encode($up);
        }
        return $this->render('index', [
        	'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Subcategory model.
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
     * Creates a new Subcategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    { 
        $model = new Subcategory();

         if ($model->load(Yii::$app->request->post())) {
            	$model->dt_deleted_at = null;
            	$model->save();

           $model->image = UploadedFile::getInstance($model,'image');
            
            if(!empty($model->image)){
                
                $imageName = 'subcat_image'.'_'.$model->id.'.'.$model->image->extension;
                $localImagePath = 'uploads/category/'.$imageName;
                $localImageThumbPath = 'uploads/category/thumbs/'.$imageName;
                $localImageMidsizeThumbPath = 'uploads/category/thumbs/midsize/'.$imageName;

                $model->image->saveAs($localImagePath);
                Image::thumbnail( $localImagePath, 100, 100)
                    ->save($localImageThumbPath, ['quality' => 50]);
                Image::thumbnail( $localImagePath, 250, 186)
                    ->save($localImageMidsizeThumbPath, ['quality' => 50]);

                Yii::$app->Helpers->uploadToS3($localImagePath, 'category/'.$imageName);  
                Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'category/thumbs/'.$imageName);                           
                Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'category/thumbs/midsize/'.$imageName);                           
                
                $model->s_image = $imageName;
                $model->save();

                unlink($localImagePath);
                unlink($localImageThumbPath);
                unlink($localImageMidsizeThumbPath);
            }
          }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->slug = strtolower(str_replace(" ", "-", trim($model->name)));
            $model->save();
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Subcategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	
        if ($model->load(Yii::$app->request->post())) {
            $model->slug = strtolower(str_replace(" ", "-", trim($model->name)));
          if ($model->save())        
           {   $model->image = UploadedFile::getInstance($model,'image');          
              if($model->image)
                {    $imageName = 'subcat_image'.'_'.$model->id.'.'.$model->image->extension;
                    $localImagePath = 'uploads/category/'.$imageName;
                    $localImageThumbPath = 'uploads/category/thumbs/'.$imageName;
                     $localImageMidsizeThumbPath = 'uploads/category/thumbs/midsize/'.$imageName;

                    $model->image->saveAs($localImagePath);
                    Image::thumbnail( $localImagePath, 100, 100)
                        ->save($localImageThumbPath, ['quality' => 50]);
                        Image::thumbnail( $localImagePath, 250, 186)
                    ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                    Yii::$app->Helpers->uploadToS3($localImagePath, 'category/'.$imageName);  
                    Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'category/thumbs/'.$imageName);     
                    Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'category/thumbs/midsize/'.$imageName);                           
                    $model->s_image = $imageName;
                $model->save();
                unlink($localImagePath);
                unlink($localImageThumbPath);
                unlink($localImageMidsizeThumbPath);
                }
           
           }
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Subcategory model.
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
     * Finds the Subcategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Subcategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Subcategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

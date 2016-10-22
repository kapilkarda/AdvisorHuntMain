<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$searchModel = new CategorySearch();

    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);  //Modified by Aninda 6/5
        
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $catId = Yii::$app->request->post('editableKey');
            $up = Yii::$app->db->createCommand('UPDATE `category` SET '.$_POST['editableAttribute'].' = "'.current($_POST['Category'])[$_POST['editableAttribute']].'" WHERE category.id = '.$catId)->execute();
            // can save model or do something before saving model      
            return json_encode($up);
        }
        return $this->render('index', [
        	'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();
        if ($model->load(Yii::$app->request->post())) {
            	$model->dt_deleted_at = null;
            	$model->save();
		   $model->imagei = UploadedFile::getInstance($model,'imagei');
            //$imageName = Yii::$app->security->generateRandomString();
            if(!empty($model->imagei)){              
                //$imageName = 'cat_image'.'_'.$model->id;
        		$imageName = 'cat_image'.'_'.$model->id.'.'.$model->imagei->extension;
        		
        		$localImagePath = 'uploads/category/'.$imageName;
                $localImageThumbPath = 'uploads/category/thumbs/'.$imageName;
                $localImageMidsizeThumbPath = 'uploads/category/thumbs/midsize/'.$imageName;
		
		$model->imagei->saveAs($localImagePath);
                Image::thumbnail( $localImagePath, 100, 100)
                    ->save($localImageThumbPath, ['quality' => 50]);
                Image::thumbnail( $localImagePath, 250, 186)
                    ->save($localImageMidsizeThumbPath, ['quality' => 50]);

                Yii::$app->Helpers->uploadToS3($localImagePath, 'category/'.$imageName);  
                Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'category/thumbs/'.$imageName);                           
                Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'category/thumbs/midsize/'.$imageName);                           
                
                $model->image = $imageName;
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
     * Updates an existing Category model.
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
           {    $model->imagei = UploadedFile::getInstance($model,'imagei');         
              if($model->imagei)
                {  
                    $imageName = 'cat_image'.'_'.$model->id.'.'.$model->imagei->extension;
                
                    $localImagePath = 'uploads/category/'.$imageName;
                    $localImageThumbPath = 'uploads/category/thumbs/'.$imageName;
                     $localImageMidsizeThumbPath = 'uploads/category/thumbs/midsize/'.$imageName;

                    $model->imagei->saveAs($localImagePath);
                    Image::thumbnail( $localImagePath, 100, 100)
                        ->save($localImageThumbPath, ['quality' => 50]);
                        Image::thumbnail( $localImagePath, 250, 186)
                    ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                    Yii::$app->Helpers->uploadToS3($localImagePath, 'category/'.$imageName);  
                    Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'category/thumbs/'.$imageName);     
                    Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'category/thumbs/midsize/'.$imageName);                           
                    $model->image = $imageName;
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
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         $model = $this->findModel($id);
         $model->dt_deleted_at = date("Y-m-d h:i:s");
         $model->save();
         
       // $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
<?php

namespace backend\controllers;

use Yii;
use backend\models\Project;
use backend\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Zipcode;
use yii\filters\AccessControl;

//use backend\controllers\Zipcode;
/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
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
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {    
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            
            // instantiate your book model for saving
            $projId = Yii::$app->request->post('editableKey');
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `project` SET '.$_POST['editableAttribute'].' = "'.current($_POST['Project'])[$_POST['editableAttribute']].'" WHERE project.pk_i_id = '.$projId)->execute();
            // can save model or do something before saving model                         
            return json_encode($up);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
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
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();
              if ($model->load(Yii::$app->request->post()) && $model->validate()){
                 $model->attributes=$_POST['Project'];
                 $zip = Zipcode::find()
                ->where('zip = :zip', [':zip' => $_POST['Project']['zip']])
                ->one();
                 $model->fk_i_zip_id = $zip->id;
                 $model->dt_deleted_at = null;
                $model->save(false);
                        return $this->redirect(['view', 'id' => $model->pk_i_id]);
                   
                
         }
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } */else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->attributes=$_POST['Project'];
                 $zip = Zipcode::find()
                ->where('zip = :zip', [':zip' => $_POST['Project']['zip']])
                ->one();
                 $model->fk_i_zip_id = $zip->id;
            $model->save(false);return $this->redirect(['view', 'id' => $model->pk_i_id]);
          }

       /* if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } */else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
      Yii::$app->db->createCommand('UPDATE `project` SET dt_deleted_at = "'.date("Y-m-d h:i:s").'" WHERE project.pk_i_id = '.$id)->execute();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

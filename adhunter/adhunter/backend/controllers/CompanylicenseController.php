<?php

namespace backend\controllers;

use Yii;

use backend\models\CompanyLicense;
use backend\models\CompanyLicenseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\html;
use yii\filters\AccessControl;

/**
 * CompanyLicenseController implements the CRUD actions for CompanyLicense model.
 */
class CompanylicenseController extends Controller
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
     * Lists all CompanyLicense models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyLicenseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         //$dataProvider->query->where('dt_deleted_at IS NULL');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyLicense model.
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
     * Creates a new CompanyLicense model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyLicense();
        if(isset($_GET['company_id'])){
            $model->fk_i_company_id = $_GET['company_id'];
        }
        if ($model->load(Yii::$app->request->post())) {
             $model->attributes=$_POST['CompanyLicense'];
            $model->dt_expiration = $_POST['dt_expiration'];
            
            	$model->dt_deleted_at = null;
             //echo "<pre>"; print_r( $model->attributes);echo "</pre>";die("######");
           if($model->save()){
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
     * Updates an existing CompanyLicense model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
          if ($model->load(Yii::$app->request->post())) {
              //$model->attributes=$_POST['CompanyLicense'];
              // $lab = $model->dt_expiration = $_POST['dt_expiration'];
              //print_r($lab);die("#######");
           if($model->dt_expiration)
           {
           $model->attributes=$_POST['CompanyLicense'];
            $model->dt_expiration = $_POST['dt_expiration'];
             $model->save();
           }
          
          //$model->save();

      //  if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyLicense model.
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
     * Finds the CompanyLicense model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyLicense the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyLicense::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\models\CompanyServices;
use backend\models\CompanyServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CompanyservicesController implements the CRUD actions for CompanyServices model.
 */
class CompanyservicesController extends Controller
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
     * Lists all CompanyServices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          $dataProvider->query->where('dt_deleted_at IS NULL');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyServices model.
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
     * Creates a new CompanyServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyServices();

           if(isset($_GET['company_id'])){
                $model->fk_i_company_id = $_GET['company_id'];
            
            }
      
        if ($model->load(Yii::$app->request->post())) {
            // print"<pre>";print_r($_POST['fk_i_service_id']);print"<pre>";die("DDDDDDD");
            $company_id = $model->fk_i_company_id;
                if(isset($_POST['fk_i_service_id'])){             
                    Yii::$app->db->createCommand()->delete('company_serivces', ['fk_i_company_id' => $company_id])->execute();       
                    foreach ($_POST['fk_i_service_id'] as $value) {
                        $CompanyServices = CompanyServices::find()
                                ->where('fk_i_company_id = :company', [':company' => $company_id])
                                ->andWhere('fk_i_service_id = :subcategroy', [':subcategroy' => $value])
                                ->all();
                        if(count($CompanyServices) == 0){
                            $new_CompanyServices = new CompanyServices;
                            $new_CompanyServices->fk_i_company_id = $company_id;
                            $new_CompanyServices->fk_i_service_id = $value;
                            $new_CompanyServices->save();
                        }
                                         
                    }
                    return 1;
                }         
            // return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompanyServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyServices model.
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
     * Finds the CompanyServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\models\CompanyServiceArea;
use backend\models\CompanyServiceAreaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Zipcode;
use yii\filters\AccessControl;

/**
 * CompanyserviceareaController implements the CRUD actions for CompanyServiceArea model.
 */
class CompanyserviceareaController extends Controller
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
     * Lists all CompanyServiceArea models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyServiceAreaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         //$dataProvider->query->where('dt_deleted_at IS NULL');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyServiceArea model.
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
     * Creates a new CompanyServiceArea model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyServiceArea();
        if(isset($_GET['company_id'])){
           $model->fk_i_company_id = $_GET['company_id'];
        }

       if ($model->load(Yii::$app->request->post())) {
            // print_r($_POST['CompanyServiceArea']['zip']);die("#######");
           $zip = Zipcode::find()
                ->where('zip = :zip', [':zip' =>  $_POST['CompanyServiceArea']['zip']])
                ->one();
             
            if(count($zip) != 0){
                $servicearea = CompanyServiceArea::find()
                    ->where('fk_i_service_area_zip = :zip', [':zip' =>  $zip->id])
                    ->andWhere('fk_i_company_id = :comapny', [':comapny' =>  $_POST['CompanyServiceArea']['fk_i_company_id']])
                    ->one();
                if(count($servicearea) == 0) {
                    $result = Yii::$app->db->createCommand()->insert('company_service_area', [
                        'fk_i_service_area_zip' => $zip->id,
                        'fk_i_company_id' => $_POST['CompanyServiceArea']['fk_i_company_id'],
                    ])->execute();

                    // $new_service_area = new CompanyServiceArea;
                    // $new_service_area->fk_i_service_area_zip = $zip->id;
                    // $new_service_area->fk_i_company_id = $_POST['CompanyServiceArea']['fk_i_company_id'];
                    // $new_service_area->save();

                    // print_r($new_service_area->fk_i_service_area_zip);die("DDD");
                    if($result){
                        return 1;
                    }                    
                }else{
                    return "Already Exist";
                }
            }else{
                    return "Invalid Zip";
                }           
                    
        }else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompanyServiceArea model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

      //  if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
               if ($model->load(Yii::$app->request->post()) && $model->validate()) {
               $zip = Zipcode::find()
                ->where('zip = :zip', [':zip' =>  $_POST['CompanyServiceArea']['zip']])
                ->one();
                 $model->fk_i_service_area_zip = $zip->id;
                 $model->save();
            
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyServiceArea model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
         //$model = $this->findModel($id);
         //$model->dt_deleted_at = date("Y-m-d h:i:s");
         //$model->save();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompanyServiceArea model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyServiceArea the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyServiceArea::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

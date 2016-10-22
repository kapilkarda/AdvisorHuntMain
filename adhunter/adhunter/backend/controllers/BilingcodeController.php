<?php

namespace backend\controllers;

use Yii;
use backend\models\BilingCode;
use backend\models\BilingCodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BilingCodeController implements the CRUD actions for BilingCode model.
 */
class BilingcodeController extends Controller
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
     * Lists all BilingCode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BilingCodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $bilingcodeId = Yii::$app->request->post('editableKey');
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `biling_code` SET '.$_POST['editableAttribute'].' = "'.current($_POST['BilingCode'])[$_POST['editableAttribute']].'" WHERE biling_code.pk_i_id = '.$bilingcodeId )->execute();
            // can save model or do something before saving model                         
            return json_encode($up);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BilingCode model.
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
     * Creates a new BilingCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BilingCode();
         if ($model->load(Yii::$app->request->post())) {
           // echo "<pre>"; print_r($_POST);echo "</pre>";die("GGGGGG");
            $model->attributes=$_POST['BilingCode'];
            $model->i_biling_Code = Yii::$app->Helpers->random_string(10);
            $model->dt_billing_code_start_date = $_POST['dt_billing_code_start_date'];
            $model->dt_billing_code_end_date = $_POST['dt_billing_code_end_date'];
            $model->dt_deleted_at = null;
                if($model->save() && $model->i_default_billing == 1){
                    Yii::$app->db->createCommand('UPDATE biling_code SET i_default_billing=0 WHERE pk_i_id!= :id', [
                            ':id' => $model->pk_i_id
                        ])->execute();
                }
           }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BilingCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>"; print_r($_POST['BilingCode']['i_default_billing']);echo "</pre>";die("GGGGGG");
                if($model->dt_billing_code_start_date && $model->dt_billing_code_end_date)
                {
                    $model->attributes=$_POST['BilingCode'];
                    $model->dt_billing_code_start_date = $_POST['dt_billing_code_start_date'];
                    $model->dt_billing_code_end_date = $_POST['dt_billing_code_end_date'];
                }
            } 
            if($model->save() && $model->i_default_billing == 1){
                Yii::$app->db->createCommand('UPDATE biling_code SET i_default_billing=0 WHERE pk_i_id!= :id', [
                        ':id' => $model->pk_i_id
                    ])->execute();
            }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BilingCode model.
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
     * Finds the BilingCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BilingCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BilingCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

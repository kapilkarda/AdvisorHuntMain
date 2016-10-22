<?php

namespace backend\controllers;

use Yii;
use backend\models\CustomerInvoice;
use backend\models\CustomerinvoiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerinvoiceController implements the CRUD actions for customerinvoice model.
 */
class CustomerinvoiceController extends Controller
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
     * Lists all customerinvoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerinvoiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single customerinvoice model.
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
     * Creates a new customerinvoice model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new customerinvoice();

        if ($model->load(Yii::$app->request->post())) {
             $model->dt_deleted_at = null;
                 $model->save();
             $model->attributes=$_POST['CustomerInvoice'];
            $model->dt_invoice_date = $_POST['dt_invoice_date'];
             $model->dt_paid_date = $_POST['dt_paid_date'];
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing customerinvoice model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->dt_invoice_date && $model->dt_paid_date)
           {
           $model->attributes=$_POST['CustomerInvoice'];
            $model->dt_invoice_date = $_POST['dt_invoice_date'];
             $model->dt_paid_date = $_POST['dt_paid_date'];
           }
          $model->save();
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing customerinvoice model.
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
     * Finds the customerinvoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return customerinvoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = customerinvoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

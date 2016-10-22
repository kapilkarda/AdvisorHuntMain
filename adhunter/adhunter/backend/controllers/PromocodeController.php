<?php

namespace backend\controllers;

use Yii;
use backend\models\PromoCode;
use backend\models\PromoCodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PromoCodeController implements the CRUD actions for PromoCode model.
 */
class PromocodeController extends Controller
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
     * Lists all PromoCode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PromoCodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $promo_codeID = Yii::$app->request->post('editableKey');
            // return json_encode(current($_POST['Company'])[$_POST['editableAttribute']]); 
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `promo_code` SET '.$_POST['editableAttribute'].' = "'.current($_POST['PromoCode'])[$_POST['editableAttribute']].'" WHERE promo_code.pk_i_id = '.$promo_codeID)->execute();
            // can save model or do something before saving model              
            return json_encode($up);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PromoCode model.
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
     * Creates a new PromoCode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PromoCode();

        if ($model->load(Yii::$app->request->post())) {
        	 $model->i_code = Yii::$app->Helpers->random_string(10);
             $model->dt_start_date = $_POST['dt_start_date'];
	    	 $model->dt_end_date = $_POST['dt_end_date'];
             $model->dt_deleted_at = null;
             $model->save();
            return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PromoCode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
             if($model->dt_start_date && $model->dt_end_date)
           {
             if($model->dt_start_date && $model->dt_end_date!==null)
             {
               // $model->attributes=$_POST['referral'];
                $model->dt_start_date = $_POST['dt_start_date'];
                $model->dt_end_date = $_POST['dt_end_date'];
                $model->save();
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
     * Deletes an existing PromoCode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
         $model->dt_deleted_at = date("Y-m-d h:i:s");
         $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the PromoCode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PromoCode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PromoCode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

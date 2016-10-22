<?php

namespace backend\controllers;

use Yii;
use backend\models\Referral;
use backend\models\BilingCode;
use backend\models\ReferralSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReferralController implements the CRUD actions for referral model.
 */
class ReferralController extends Controller
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
     * Lists all referral models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReferralSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single referral model.
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
     * Creates a new referral model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new referral();
       if ($model->load(Yii::$app->request->post())) {
         $model->dt_referral_sent_date = $_POST['dt_referral_sent_date'];
	$model->dt_last_reminder_date = $_POST['dt_last_reminder_date'];
        
            $defaultBilling = BilingCode::find()
            ->where(['i_default_billing' => 1])
            ->one();
            $model->fk_i_referral_billing_code = $defaultBilling['pk_i_id'];
              $model->dt_deleted_at = null;
              $model->save(false);
            //return $this->redirect(['view', 'id' => $model->pk_i_id]);
         return $this->redirect(['view', 'id' => $model->pk_i_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing referral model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             if($model->dt_referral_sent_date && $model->dt_last_reminder_date)
           {
             if($model->dt_referral_sent_date && $model->dt_last_reminder_date!==null)
             {
               // $model->attributes=$_POST['referral'];
                $model->dt_referral_sent_date = $_POST['dt_referral_sent_date'];
                $model->dt_last_reminder_date = $_POST['dt_last_reminder_date'];
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
     * Deletes an existing referral model.
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
     * Finds the referral model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return referral the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = referral::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

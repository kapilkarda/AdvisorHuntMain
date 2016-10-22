<?php

namespace backend\controllers;

use Yii;
use backend\models\CompanyReviewComment;
use backend\models\CompanyReviewCommentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CompanyreviewcommentController implements the CRUD actions for CompanyReviewComment model.
 */
class CompanyreviewcommentController extends Controller
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
     * Lists all CompanyReviewComment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyReviewCommentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $companyId = Yii::$app->request->post('editableKey');
            // return json_encode(current($_POST['Company'])[$_POST['editableAttribute']]); 
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `company_review_comment` SET '.$_POST['editableAttribute'].' = "'.current($_POST['CompanyReviewComment'])[$_POST['editableAttribute']].'" WHERE company_review_comment.pk_i_id = '.$companyId)->execute();
            // can save model or do something before saving model              
            return json_encode($up);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyReviewComment model.
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
     * Creates a new CompanyReviewComment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyReviewComment();
         if ($model->load(Yii::$app->request->post())) {
            	$model->dt_deleted_at = null;
            	$model->save();
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
     * Updates an existing CompanyReviewComment model.
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
     * Deletes an existing CompanyReviewComment model.
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
     * Finds the CompanyReviewComment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyReviewComment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyReviewComment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

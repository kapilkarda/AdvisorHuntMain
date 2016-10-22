<?php

namespace backend\controllers;

use Yii;
use backend\models\Token;
use backend\models\TokenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Zipcode;
use yii\filters\AccessControl;
use backend\models\City;
use backend\models\State;

/**
 * TokenController implements the CRUD actions for Token model.
 */
class TokenController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'bulkupdate'],
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
     * Lists all Token models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TokenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // validate if there is a editable input saved via AJAX
        if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $tokenId = Yii::$app->request->post('editableKey');
            // return json_encode(current($_POST['Company'])[$_POST['editableAttribute']]); 
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `token` SET '.$_POST['editableAttribute'].' = "'.current($_POST['Token'])[$_POST['editableAttribute']].'" WHERE token.pk_i_id = '.$tokenId)->execute();
            // can save model or do something before saving model              
            return json_encode($up);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Token model.
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
     * Creates a new Token model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Token();
      //print_r($_POST);die("######");
        if ($model->load(Yii::$app->request->post()) ) {
            
                $model->attributes=$_POST['Token'];
                    
                 $city = City::find()
                ->where('name = :name', [':name' => $_POST['Token']['city']])
                ->one();                 

                    if(isset($city->id)){
                          $model->city_id = $city->id;
                    }                      
                    else{
                        $model->addError('city', "Invalid City name
                            ");
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                    
                   $model->state_id = $_POST['Token']['state_id'];
                    
                    $zip = Zipcode::find()
                    ->where('zip = :zip', [':zip' => $_POST['Token']['zip']])
                    ->one();
                  //$model->fk_i_zip_id = $zip->id;
                 if(isset($zip->id)){
                        $model->fk_i_zip_id = $zip->id;
                    }                      
                    else{
                        $model->addError('zip', "Invalid Zip");
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }
                
                
                $model->dt_deleted_at = null;
                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->pk_i_id]);
                    } 
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Token model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->attributes=$_POST['Token'];
            
              $city = City::find()
                ->where('name = :name', [':name' => $_POST['Token']['city']])
                ->one();
               //  $model->attributes=$_POST['Token'];
                 $model->city_id = $city->id;
                 
                 $zip = Zipcode::find()
                ->where('zip = :zip', [':zip' => $_POST['Token']['zip']])
                ->one();
                 $model->fk_i_zip_id = $zip->id;
            $model->save(false);return $this->redirect(['view', 'id' => $model->pk_i_id]);
          }

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->pk_i_id]);
        }*/ else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Token model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       Yii::$app->db->createCommand('UPDATE `token` SET dt_deleted_at = "'.date("Y-m-d h:i:s").'" WHERE token.pk_i_id = '.$id)->execute();
       return $this->redirect(['index']);
    }

    /**
     * Finds the Token model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Token the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Token::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //Bulk Update tokens
    public function actionBulkupdate()
    {
         if (Yii::$app->request->post()) {
            print_r($_POST['records']);
            print_r(explode(",", $_POST['records']));

            Token::updateAll(['i_token_count' => $_POST['token_value']], ['in', 'pk_i_id', explode(',', $_POST['records'])]);
            return $this->redirect(['index']);
          }
            else {
            return $this->redirect(['index']);
        }
    }
}

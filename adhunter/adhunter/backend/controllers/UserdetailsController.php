<?php

namespace backend\controllers;

use Yii;
use backend\models\UserDetails;
use backend\models\UserDetailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\City;
use backend\models\State;
use backend\models\Zipcode;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use webvimark\modules\UserManagement\models\User;
use yii\imagine\Image;

/**
 * UserDetailsController implements the CRUD actions for UserDetails model.
 */
class UserdetailsController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'city-state-ajax'],
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
     * Lists all UserDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //$dataProvider->query->where('dt_deleted_at IS NULL');
         if (Yii::$app->request->post('hasEditable')) {
            // instantiate your book model for saving
            $userID = Yii::$app->request->post('editableKey');
            // return json_encode(current($_POST['Company'])[$_POST['editableAttribute']]); 
            // $model->$_POST['editableAttribute'] = $_POST['Company'][0][$_POST['editableAttribute']];
            $up = Yii::$app->db->createCommand('UPDATE `user_details` SET '.$_POST['editableAttribute'].' = "'.current($_POST['UserDetails'])[$_POST['editableAttribute']].'" WHERE user_details.id = '.$userID)->execute();
            // can save model or do something before saving model              
            return json_encode($up);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserDetails model.
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
     * Creates a new UserDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
   {
        $model = new UserDetails();
        
        if ($model->load(Yii::$app->request->post())) {

              $model->attributes=$_POST['UserDetails'];

                 $zip = Zipcode::find()
                    ->where('zip = :zip', [':zip' =>  $_POST['UserDetails']['zip']])
                    ->one();
                    if(isset($zip->id)){
                        $model->zip_id = $zip->id;
                    }                      
                    else{
                        $model->addError('zip', "Invalid Zip");
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }

                $userExist = UserDetails::find()
                    ->where('user_id = :user_id', [':user_id' =>  $_POST['UserDetails']['user_id']])
                    ->one();
                if($userExist){
                    Yii::$app->session->setFlash('danger', 'This user is already associted with another Details');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
                $isRole = \Yii::$app->db->createCommand('SELECT * FROM auth_assignment   WHERE item_name = "Customer" AND user_id = '.$_POST['UserDetails']['user_id'])->queryAll();
                // print_r($isRole);die();
                if(empty($isRole))
                    \Yii::$app->db->createCommand('INSERT INTO auth_assignment(item_name, user_id) values ("Customer", '.$_POST['UserDetails']['user_id'].')')->execute();
                //  $city = City::find()
                // ->where('name = :name', [':name' => $_POST['UserDetails']['city']])
                // ->one();
                //  $model->city_id = $city->id;
                   // print_r($model);die("######");
             

                    $user = UserDetails::find()
                    ->where('user_id = :user_id', [':user_id' =>  $_POST['UserDetails']['user_id']])
                    ->one();
                    if(isset($user->id)){
                        $model->addError('user_id', "This User Already Exist");
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }                      
          
                $model->dt_deleted_at = null;
                if($model->save())
                {
                    $model->imagei = UploadedFile::getInstance($model,'imagei');
               
                    if(!empty($model->imagei)){            
    		        $imageName = 'profile_image'.'_'.$model->id.'.'.$model->imagei->extension;
                    
    		        $localImagePath = 'uploads/profile/'.$imageName;
                    $localImageThumbPath = 'uploads/profile/thumbs/'.$imageName;
                    $localImageMidsizeThumbPath = 'uploads/profile/thumbs/midsize/'.$imageName;
    		
    		        $model->imagei->saveAs($localImagePath);
                    Image::thumbnail( $localImagePath, 100, 100)
                        ->save($localImageThumbPath, ['quality' => 50]);
                    Image::thumbnail( $localImagePath, 250, 186)
                        ->save($localImageMidsizeThumbPath, ['quality' => 50]);

                    Yii::$app->Helpers->uploadToS3($localImagePath, 'profile/'.$imageName);  
                    Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'profile/thumbs/'.$imageName);                           
                    Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'profile/thumbs/midsize/'.$imageName);                           
                    
                    $model->profile_pic = $imageName;
                    $model->save();
                    unlink($localImagePath);
                    unlink($localImageThumbPath);
                    unlink($localImageMidsizeThumbPath);
                }    

            }
            
           return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->attributes=$_POST['UserDetails'];
             // $city = City::find()
             //    ->where('name = :name', [':name' => $_POST['UserDetails']['city']])
             //    ->one();
             //    $model->attributes=$_POST['UserDetails'];
             //    $model->city_id = $city->id;
                
           
                $zip = Zipcode::find()
                    ->where('zip = :zip', [':zip' =>  $_POST['UserDetails']['zip']])
                    ->one();
                    if(isset($zip->id)){
                        $model->zip_id = $zip->id;
                        $model->save();
                    }                      
                    else{
                        $model->addError('zip', "Invalid Zip");
                        return $this->render('create', [
                            'model' => $model,
                        ]);
                    }

          
              $model->imagei = UploadedFile::getInstance($model, 'imagei');

              if ($model->save())        
               {            
                  if($model->imagei!==null)
                    {    $imageName = 'profile_image'.'_'.$model->id.'.'.$model->imagei->extension;
                        
                        $localImagePath = 'uploads/profile/'.$imageName;
                        $localImageThumbPath = 'uploads/profile/thumbs/'.$imageName;
                         $localImageMidsizeThumbPath = 'uploads/profile/thumbs/midsize/'.$imageName;

                        $model->imagei->saveAs($localImagePath);
                        Image::thumbnail( $localImagePath, 100, 100)
                            ->save($localImageThumbPath, ['quality' => 50]);
                            Image::thumbnail( $localImagePath, 250, 186)
                        ->save($localImageMidsizeThumbPath, ['quality' => 50]);


                        Yii::$app->Helpers->uploadToS3($localImagePath, 'profile/'.$imageName);  
                        Yii::$app->Helpers->uploadToS3($localImageThumbPath, 'profile/thumbs/'.$imageName);     
                        Yii::$app->Helpers->uploadToS3($localImageMidsizeThumbPath, 'profile/thumbs/midsize/'.$imageName);                           
                         $model->profile_pic = $imageName;
                        $model->save();
                        unlink($localImagePath);
                        unlink($localImageThumbPath);
                        unlink($localImageMidsizeThumbPath);
                    }
               
               }
     
           return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $city = City::findOne($model->city_id);
            $model->city = $city->name;
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {	

    	Yii::$app->db->createCommand('UPDATE `user_details` SET dt_deleted_at = "'.date("Y-m-d h:i:s").'" WHERE user_details.id = '.$id)->execute();
        return $this->redirect(['index']);
    }

    /**
     * Finds the UserDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserDetails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCityStateAjax($zipcode)
    {  
        //Find the city from City table
         $zip = Zipcode::find()
                ->where('zip = :zip', [':zip' =>  $zipcode])
                ->one();
        $city = City::findOne($zip->city_id);

        $state = State::findOne($city->state_id);

        return json_encode(array('city_id'=>$city->id, 'city_name'=> $city->name, 'state_id'=>$state->id, 'state_name'=>$state->name));
       
    }
}

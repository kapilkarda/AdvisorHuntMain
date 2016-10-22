<?php
namespace frontend\controllers;

use Yii;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AuthHandler;
use webvimark\modules\UserManagement\models\User;
use frontend\models\UploadProfilePic;
use webvimark\modules\UserManagement\models\forms\ChangeOwnPasswordForm;
/**
 * Site controller
 */
class ProfileController extends Controller
{

    public $layout = 'profile';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'settings', 'update', 'projects', 'professionals'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        // $model = new User();
       // $model = User::model()->findByPk(Yii::$app->user->identity->id);
        // print_r(\Yii::$app->user->identity);
        // print_r(Yii::$app->user->identity->id);
      // die("SA"); 
        if ( Yii::$app->user->isGuest )
        {
            return $this->goHome();
        }
        $model = User::find()
        ->where(['id' => Yii::$app->user->identity->id])
        ->one();

        $uploaded  = 0;
        $uploadmodel = new UploadProfilePic();

        if (Yii::$app->request->isPost) {
                       // $uploadmodel->profile_pic = UploadedFile::getInstanceByName('profile_pic');
            if ($uploadmodel->upload()) {
                unlink('assets/img/team/' .$model->profile_pic);
                // file is uploaded successfully
                $model->profile_pic = $uploadmodel->profile_pic->baseName . '.' . $uploadmodel->profile_pic->extension;
                $model->update(); 
            }
        }
        return $this->render('index', [
                'model' => $model, 'uploadmodel' => $uploadmodel,
            ]);
    }

        /**
     * Displays account settings.
     *
     * @return mixed
     */
    public function actionSettings()
    {
        if ( Yii::$app->user->isGuest )
        {
            return $this->goHome();
        }

        $model = User::find()
        ->where(['id' => Yii::$app->user->identity->id])
        ->one();

        $user = User::getCurrentUser();



        if ( $user->status != User::STATUS_ACTIVE )
        {
            throw new ForbiddenHttpException();
        }

        $model = new ChangeOwnPasswordForm(['user'=>$user]);

    // print_r($model['user']['first_name']); die("SAC");
        if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ( $model->load(Yii::$app->request->post()) AND $model->changePassword() )
        {
            // return $this->renderIsAjax('changeOwnPasswordSuccess');
             \Yii::$app->getSession()->setFlash('success', 'Password has been changed');
             return $this->redirect('#passwordTab');
        }
        
        return $this->render('settings', [
                'model' => $model, 
            ]);
    }

            /**
     * Displays customer projects.
     *
     * @return mixed
     */
    public function actionProjects()
    {
        return $this->render('my_projects');
    }

            /**
     * Displays customers bookmarked professionals.
     *
     * @return mixed
     */
    public function actionMyprofessionals()
    {
        return $this->render('my_professionals');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

     /**
     * Update a user.
     *
     * @return mixed
     */
    public function actionUpdate()
    {
        $model = User::find()
        ->where(['id' => Yii::$app->user->identity->id])
        ->one();

        if (Yii::$app->request->isPost) {
                $model->first_name = $_POST['first_name'];    
                $model->last_name = $_POST['last_name'];  
                $model->phone = $_POST['phone'];  
                $model->location_id = $_POST['location_id'];   
                $model->update(); 
            }
        \Yii::$app->getSession()->setFlash('success', 'Profile Updated Successfully');
        return $this->redirect(Yii::$app->request->referrer);
    }


}

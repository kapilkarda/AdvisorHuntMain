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
class ProfessionalController extends Controller
{

    public $layout = 'master';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['', ''],
                'rules' => [
                    [
                        'actions' => [''],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index'],
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
       return $this->render('index');

    }

  

}

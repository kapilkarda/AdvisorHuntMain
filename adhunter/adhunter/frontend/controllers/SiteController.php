<?php
namespace frontend\controllers;

use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
// use frontend\models\SignupForm;

use frontend\models\ContactForm;
use frontend\models\RegistrationForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\components\AuthHandler;

use webvimark\components\BaseController;
use webvimark\modules\UserManagement\components\UserAuthEvent;

use webvimark\modules\UserManagement\models\forms\LoginForm;

use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\UserManagementModule;
use Yii;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup', 'prologin','proregistration'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
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
        $this->layout = 'Home';
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) 
        {
            return $this->goHome();
        }

        $model = new LoginForm();

       if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ( $model->load(Yii::$app->request->post()) AND $model->login() )
        {
            return $this->goBack();
        }

        return $this->renderIsAjax('login', compact('model'));
    }

     public function actionPrologin()
    {
        $this->layout = 'prologin';

        if (!\Yii::$app->user->isGuest) 
        {
            return $this->goHome();
        }

        $model = new LoginForm();

       if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
        { 
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ( $model->load(Yii::$app->request->post()) AND $model->login() )
        {
            return $this->goBack();
        }

        // return $this->renderIsAjax('pro_login', compact('model'));
         return $this->render('pro_login', [
            'model' => $model,
        ]);
    }

     /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionProregistration()
    {
        $this->layout = 'prologin';
       if ( !Yii::$app->user->isGuest )
        {
            return $this->goHome();
        }

        $model = new RegistrationForm();


        if ( Yii::$app->request->isAjax AND $model->load(Yii::$app->request->post()) )
        {

            Yii::$app->response->format = Response::FORMAT_JSON;

            // Ajax validation breaks captcha. See https://github.com/yiisoft/yii2/issues/6115
            // Thanks to TomskDiver
            $validateAttributes = $model->attributes;
            unset($validateAttributes['captcha']);

            return ActiveForm::validate($model, $validateAttributes);
        }

        if ( $model->load(Yii::$app->request->post()) AND $model->validate() )
        {
            // Trigger event "before registration" and checks if it's valid
            if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_REGISTRATION, ['model'=>$model]) )
            {
                $user = $model->registerUser(false);

                // Trigger event "after registration" and checks if it's valid
                if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_REGISTRATION, ['model'=>$model, 'user'=>$user]) )
                {
                    if ( $user )
                    {
                        if ( Yii::$app->getModule('user-management')->useEmailAsLogin AND Yii::$app->getModule('user-management')->emailConfirmationRequired )
                        {
                            User::assignRole($user->id, 'Provider');
                            // \Yii::$app->getSession()->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                                // return $this->renderIsAjax('registrationWaitForEmailConfirmation', compact('user'));

                        }
                        else
                        {
                            $roles = (array)$this->module->rolesAfterRegistration;

                            foreach ($roles as $role)
                            {
                                User::assignRole($user->id, $role);
                            }

                            Yii::$app->user->login($user);

                            return $this->redirect(Yii::$app->user->returnUrl);
                        }

                    }
                }
            }

        }

        // return $this->renderIsAjax('registration', compact('model'));

        return $this->render('pro_registration', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }
        /**
     * Universal method for triggering events like "before registration", "after registration" and so on
     *
     * @param string $eventName
     * @param array  $data
     *
     * @return bool
     */
    protected function triggerModuleEvent($eventName, $data = [])
    {
        $event = new UserAuthEvent($data);

        $this->module->trigger($eventName, $event);

        return $event->isValid;
    }
}

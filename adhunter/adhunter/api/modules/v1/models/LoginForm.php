<?php
namespace api\modules\v1\models;

use Yii;
use yii\base\Model;

use \yii\db\ActiveRecord;


/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            ['email', 'email'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }


    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    { 
        if ($this->validate() && $this->verifyEmail()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    public function loginpro()
    {  
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }

    /**
     * User Email Varifed or not
     *
     * @return User|null
     */
    protected function verifyEmail()
    {

        if ($this->getUser()) {
            $userd = User::find()
                ->where('email = :email', [':email' => $this->email])
                ->andWhere('email_confirmed = :email_confirmed', [':email_confirmed' =>1])
                ->one();        
                if(!$userd){
                      $this->addError('email', 'Email not verified');
                }        
        }
        return $userd;
        
        
    }
}

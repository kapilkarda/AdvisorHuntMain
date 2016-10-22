<?php
namespace api\modules\v1\models;

use \webvimark\modules\UserManagement\models\User;
use \webvimark\modules\UserManagement\UserManagementModule;
use \yii\base\Model;
use Yii;
use yii\helpers\Html;
use \api\modules\v1\models\Company;
use \api\modules\v1\models\TokenBalance;

class RegistrationForm extends Model
{
	public $email;
	public $first_name;
	public $last_name;
    public $mobile;
	public $password;
	public $repeat_password;
	public $terms;


	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$rules = [
			// ['captcha', 'captcha', 'captchaAction'=>'/user-management/auth/captcha'],

			[['first_name','last_name', 'email', 'password', 'repeat_password'], 'required'],
			[['terms'], 'required', 'message' => 'Please Check Terms and Conditions'],
			[['first_name','last_name', 'email', 'password', 'repeat_password'], 'trim'],
            [['mobile'], 'match','pattern'=> '/^[0-9]{10}$/','message'=> 'Invalid Mobile number.'],
            ['mobile', 'validateMobile'],
			['email', 'unique',
				'targetClass'     => '\webvimark\modules\UserManagement\models\User',
				'targetAttribute' => 'email',
			],
			['email', 'email'],
			['email', 'validateEmailConfirmedUnique'],

			['password', 'string', 'max' => 255],

			['repeat_password', 'compare', 'compareAttribute'=>'password'],
		];

		return $rules;
	}


		/**
	 * Check that there is no such confirmed E-mail in the system
	 */
	public function validateEmailConfirmedUnique()
	{ 
		if ( $this->email )
		{
			$exists = User::findOne([
				'email' => $this->email,
			]);

			if ( $exists )
			{
				$this->addError('email', 'This E-mail has already been taken.');
			}
		}
	}

    public function validateMobile()
    {
        if ( !$this->mobile )
        {
                $this->addError('mobile', 'This is Invalid Mobile Number');
        }
        $exists = User::findOne([
            'i_phone_no' => $this->mobile,
        ]);

        if ( $exists )
        {
            $this->addError('mobile', 'This Mobile has already been taken.');
        }
    }


	/**
	 * @param bool $performValidation
	 *
	 * @return bool|User
	 */
	public function registerUser($performValidation = true)
	{
		if ($this->validate())
		{
			// return false;
			$user = new User();
			$user->password = $this->password;
			$user->email = $this->email;
			$user->username = $this->email;

			$user->status = User::STATUS_ACTIVE;
			$user->generateConfirmationToken();
			if($user->save()){
				 User::assignRole($user->id, 'Customer');
				$this->saveProfile($user);

				// if ( $this->sendConfirmationEmail($user) )
				// {
				// 	return $user;
				// }
				return $user;
			}
			else
			{
				return $this->errors;
			}

		}else
		{
			return false;
		}					
	}
	/**
	 * @param bool $performValidation
	 *
	 * @return bool|User
	 */
	public function registerPro($performValidation = true)
	{
		if ($this->validate())
		{
			// return false;
			$user = new User();
			$user->password = $this->password;
			$user->email = $this->email;
			$user->username = $this->first_name." ".$this->last_name;
            $user->i_phone_no = $this->mobile;

			$user->status = User::STATUS_ACTIVE;
			$user->generateConfirmationToken();
			if($user->save()){								
				User::assignRole($user->id, 'Provider');
				// $this->createCompany($user);
				if( $this->sendConfirmationEmail($user) )
				{
					return $user;
				}
				return $user;
			}
			else
			{
				return $this->errors;
			}

		}else
		{
			return false;
		}		
	}

	/**
	 * Implement your own logic if you have user profile and save some there after registration
	 *
	 * @param User $user
	 */
	protected function saveProfile($user)
	{
	}

	/**
	 * Save Company frist time while pro sign up
	 *
	 * @param User $user
	 */
	protected function createCompany($user)
	{
		
	}


	/**
	 * @param User $user
	 *
	 * @return bool
	 */
	protected function sendConfirmationEmail($user)
	{
        // return Yii::$app->mailer->compose(['registrationFormViewFile', 'user' => $user])
        //     ->setFrom(Yii::$app->params['adminEmail'])
        //     ->setTo($user->email)
        //     ->setSubject('E-mail confirmation for '.Yii::$app->name)
        //     ->send(); 
		
		// return Yii::$app->mailer->compose(\Yii::$app->getModule('user-management')->mailerOptions['registrationFormViewFile'], ['user' => $user])
		// 	->setFrom(\Yii::$app->getModule('user-management')->mailerOptions['from'])
		// 	->setTo($user->email)
		// 	->setSubject(UserManagementModule::t('front', 'E-mail confirmation for') . ' ' . Yii::$app->name)
		// 	->send();
	}

	/**
	 * Check received confirmation token and if user found - activate it, set email, roles and log him in
	 *
	 * @param string $token
	 *
	 * @return bool|User
	 */
	public function checkConfirmationToken($token)
	{
		$user = User::findInactiveByConfirmationToken($token);

		if ( $user )
		{
			$user->email = $user->email;
			$user->status = User::STATUS_ACTIVE;
			$user->email_confirmed = 1;
			$user->removeConfirmationToken();
			$user->save(false);

			$roles = (array)\Yii::$app->getModule('user-management')->rolesAfterRegistration;

			foreach ($roles as $role)
			{
				User::assignRole($user->id, $role);
			}

			\Yii::$app->user->login($user);

			return $user;
		}

		return false;
	}
}

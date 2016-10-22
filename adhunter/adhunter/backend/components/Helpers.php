<?php
	namespace backend\components;

	use yii;
	use yii\base\Component;
	use webvimark\modules\UserManagement\models\User;
	use backend\models\UserDetails;
	use backend\models\Company;
	use backend\models\City;
	use backend\models\State;
	use backend\models\Country;
	use backend\models\Zipcode;
	use backend\models\TokenBalance;


	class Helpers extends component
	{	
		//Create Random String with 10 character
		public function random_string($length) {
		    $key = '';
		    $keys = array_merge(range(0, 9), range('A', 'Z'));

		    for ($i = 0; $i < $length; $i++) {
		        $key .= $keys[array_rand($keys)];
		    }
		    return $key;
		}
		//Create Date format
		public function date($date) {	
			if($date == '0000-00-00 00:00:00')
				return "--";
		    return date("M d, Y", strtotime($date)); 
		}

		public function toArray($obj)
		{
		    if (is_object($obj)) $obj = (array)$obj;
		    if (is_array($obj)) {
		        $new = array();
		        foreach ($obj as $key => $val) {
		            $new[$key] = $this->toArray($val);
		        }
		    } else {
		        $new = $obj;
		    }
		    return $new;
		}
		public function userAddressByEmail($email){
			$model = User::find()
	    		->where('email = :email', [':email' => $email])
	    		->one();

	    	$UserDetails = UserDetails::find()
	    		->where('user_id = :user_id', [':user_id' => $model->id])
	    		->one();
	    		echo "DONE";
    		if($UserDetails){
    			$city = City::findOne($UserDetails->city_id);
    			$state = State::findOne($UserDetails->state_id);
    			$country = Country::findOne($UserDetails->country_id);
    			$zipcode = Zipcode::findOne($UserDetails->zip_id);
    			return $UserDetails->address.' '.$UserDetails->address1.' '.$city->id.' '.$state->id.' '.$country->id.' '.$zipcode->id; 
    		}else{
    			$CompanyDetails = Company::find()
		    		->where('user_id = :user_id', [':user_id' => $model->id])
		    		->one();
	    		$city = City::findOne($CompanyDetails->city_id);
    			$state = State::findOne($CompanyDetails->state_id);
    			$country = Country::findOne($CompanyDetails->country_id);
    			$zipcode = Zipcode::findOne($CompanyDetails->zip_id);
    			return $CompanyDetails->address.' '.$CompanyDetails->address1.' '.$city->name.' '.$state->name.' '.$country->name.' '.$zipcode->zip; 
    		}
	    		die("DONE");
		}

		public function usersFullNameByEmail($email){
			$model = User::find()
	    		->where('email = :email', [':email' => $email])
	    		->one();
	    	$UserDetails = UserDetails::find()
	    		->where('user_id = :user_id', [':user_id' => $model->id])
	    		->one();
	    	if($UserDetails){
    			return $UserDetails->first_name.' '.$UserDetails->last_name;
    		}else{
    			return "";
    		}
		}

		public function lastLoginDateByEmail($email){
			$model = User::find()
	    		->where('email = :email', [':email' => $email])
	    		->one();
	    	return $model->last_login_date;	
		}

		//Added by Aninda to find the last login date by user ID - 9/13/2016
        public function lastLoginDateByUserID($UsrID){
            $model = User::find()
                ->where('id = :id', [':id' => $UsrID])
                ->one();
            return $model->last_login_date;
        }

        //Added by Aninda to find phone number by user ID - 9/13/2016
        public function PhoneNumberByUserID($UsrID){
            $model = User::find()
                ->where('id = :id', [':id' => $UsrID])
                ->one();
            return $model->i_phone_no;
        }

        //Added by Aninda to find phone number Company Created - 9/13/2016

        //SELECT DATE(created_at) as date, count(id) as number FROM `company`  where created_at between (CURDATE() - INTERVAL 10 DAY) AND CURDATE() GROUP BY date
        public function NumberOfNewCompany($Days){

//            $model = company::find()
////                ->select(['count(id)' => 'number'])
////                ->from('company');
//                ->where('id = :id', [':id' => 14])
//                ->one();


//            return $rows->id;
            return 4;
        }

		public function tokenBalanceByEmail($email){
			$model = User::find()
	    		->where('email = :email', [':email' => $email])
	    		->one();
	    	$CompanyDetails = Company::find()
		    		->where('user_id = :user_id', [':user_id' => $model->id])
		    		->one();
		    if($CompanyDetails){
		    	$tokenBalace = TokenBalance::find()
		    		->where('fk_i_user_id = :user_id', [':user_id' => $CompanyDetails->user_id])
	    			->one();
	    			if(isset($tokenBalace->i_current_balance))
	    			 	return $tokenBalace->i_current_balance;
	    			else
	    				return '';
		    }
		    else{
		    	return '';
		    }		

		}

		public function uploadToS3($localImagePath, $s3ImagePath){
			
            Yii::$app->get('s3bucket')->put($s3ImagePath, fopen($localImagePath, 'r+'));
		}
	}
?>
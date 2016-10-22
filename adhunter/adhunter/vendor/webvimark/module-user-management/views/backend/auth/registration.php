<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\RegistrationForm $model
 */

	$this->title = UserManagementModule::t('front', 'Registration');
	$this->params['breadcrumbs'][] = $this->title;
?>



    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Registration</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Registration</li>
            </ul>
        </div><!--/container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

                	<?php $form = ActiveForm::begin([
                		'options'=>['autocomplete'=>'off', 'class'=>'reg-page'],
						'id'=>'user',
						'layout'=>'horizontal',
						'validateOnBlur'=>false,
					]); ?>
                    <div class="reg-header">
                        <h2>Register a new account</h2>
                        <p>Already Signed Up? Click <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/login"> Sign-in </a> to login your account.</p>
                    </div>

                    <label>First Name</label>
                    <?= $form->field($model, 'first_name')->textInput([ 'autocomplete'=>'off', 'autofocus'=>true, 'class'=>'form-control margin-bottom-20'])->label(false) ?>

                    <label>Last Name</label>
                    <?= $form->field($model, 'last_name')->textInput([ 'autocomplete'=>'off', 'autofocus'=>true, 'class'=>'form-control margin-bottom-20'])->label(false) ?>

                    <label>Email Address <span class="color-red">*</span></label>
                    <?= $form->field($model, 'username')->textInput([ 'autocomplete'=>'off', 'autofocus'=>true, 'class'=>'form-control margin-bottom-20'])->label(false) ?>
                    <!-- <input type="text" class="form-control margin-bottom-20"> -->

                    <div class="row">
                        <div class="col-sm-6">
                            <label>Password <span class="color-red">*</span></label>
                            <!-- <input type="password" class="form-control margin-bottom-20"> -->
                            <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off'])->label(false) ?>
                        </div>
                        <div class="col-sm-6">
                            <label>Confirm Password <span class="color-red">*</span></label>
                            <!-- <input type="password" class="form-control margin-bottom-20"> -->
                            <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off'])->label(false) ?>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6 checkbox">
                            <label>
                                <input type="checkbox">
                                I read <a href="page_terms.html" class="color-green">Terms and Conditions</a>
                            </label>
                        </div>
                        <div class="col-lg-6 text-right">
                            <?= Html::submitButton(
								'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('front', 'Register'),
								['class' => 'btn-u']
							) ?>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div><!--/container-->
    <!--=== End Content Part ===-->
<script type="text/javascript" src="assets_nw/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
			$('.form-group.field-registrationform-first_name > div').removeClass('col-sm-6').removeClass('col-sm-offset-3');
	  		$('.form-group.field-registrationform-first_name > div').addClass('col-sm-12');

	  	  	$('.form-group.field-registrationform-last_name > div').removeClass('col-sm-6').removeClass('col-sm-offset-3');
	  		$('.form-group.field-registrationform-last_name > div').addClass('col-sm-12');

			 $('.form-group.field-registrationform-username.required > div').removeClass('col-sm-6').removeClass('col-sm-offset-3');
			 $('.form-group.field-registrationform-username.required > div').addClass('col-sm-12');

			 $('.form-group.field-registrationform-password.required > div').removeClass('col-sm-6').removeClass('col-sm-offset-3');
			 $('.form-group.field-registrationform-password.required > div').addClass('col-sm-12');

	  		$('.form-group.field-registrationform-repeat_password.required > div').removeClass('col-sm-6').removeClass('col-sm-offset-3');
	  		$('.form-group.field-registrationform-repeat_password.required > div').addClass('col-sm-12');

	}); 
</script>



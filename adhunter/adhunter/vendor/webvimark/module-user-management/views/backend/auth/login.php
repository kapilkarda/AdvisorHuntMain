<?php
/**
 * @var $this yii\web\View
 * @var $model webvimark\modules\UserManagement\models\forms\LoginForm
 */

use webvimark\modules\UserManagement\components\GhostHtml;
use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = UserManagementModule::t('front', 'Login');
?>
	 <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Login</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Login</li>
            </ul>
        </div><!--/container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content">
    	<div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">

              	<?php $form = ActiveForm::begin([
              			'id' => 'login-form',
						'options'=>['autocomplete'=>'off', 'class'=>'reg-page'],
						'validateOnBlur'=>false,
						'fieldConfig' => [
							'template'=>"{input}\n{error}",
						],
					]) ?>
                    <div class="reg-header">
                        <h2>Login to your account</h2>
                        Don't have an account?  <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/registration"> Sign Up </a>
                    </div>

                    <div class="input-group margin-bottom-10">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <?= $form->field($model, 'username')
							->textInput(['placeholder'=>$model->getAttributeLabel('username'), 'autocomplete'=>'off', 'class'=>'form-control']) ?>
                    </div>
                    <div class="input-group margin-bottom-10">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <?= $form->field($model, 'password')
							->passwordInput(['placeholder'=>$model->getAttributeLabel('password'), 'autocomplete'=>'off']) ?>

                    </div>

                    <div class="row">
                        <div class="col-md-6 checkbox">
                            <?= $form->field($model, 'rememberMe')->checkbox(['value'=>true]) ?>
                        </div>
                        <div class="col-md-6">
                           
                            <?= Html::submitButton(
								UserManagementModule::t('front', 'Login'),
								['class' => 'btn-u pull-right']
							) ?>
                        </div>
                    </div>

                    <hr>

                    <h4>Forget your Password ?</h4>
                    <p>no worries, 
                    	<?= GhostHtml::a(
								UserManagementModule::t('front', "click here"),
								['/user-management/auth/password-recovery']
							) ?>
                     to reset your password.</p>
                </form>
            </div>
        </div><!--/row-->
    </div><!--/container-->
    <!--=== End Content Part ===-->

<script type="text/javascript" src="assets_nw/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  $('.form-group.field-loginform-username.required').css("margin-top", "-10px");
	  $('.form-group.field-loginform-password.required').css("margin-top", "-10px");


	}); 
</script>
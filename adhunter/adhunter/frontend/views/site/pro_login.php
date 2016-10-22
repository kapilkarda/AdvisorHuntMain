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

<!--=== Content Part ===-->    
<div class="container">
    <!--Reg Block-->
    <div class="reg-block">
        <div class="reg-block-header">
            <h2>Pro Sign In</h2>
           <!--  <ul class="social-icons text-center">
                <li><a class="rounded-x social_facebook" data-original-title="Facebook" href="#"></a></li>
                <li><a class="rounded-x social_twitter" data-original-title="Twitter" href="#"></a></li>
                <li><a class="rounded-x social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                <li><a class="rounded-x social_linkedin" data-original-title="Linkedin" href="#"></a></li>
            </ul> -->
            <p>Don't Have Account? Click <a class="color-green" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=site/proregistration">Sign Up</a> to registration.</p>            
        </div>
			<?php $form = ActiveForm::begin([
              			'id' => 'login-form',
						'options'=>['autocomplete'=>'off'],
						'validateOnBlur'=>false,
						'fieldConfig' => [
							'template'=>"{input}\n{error}",
						],
					]) ?>
                 
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <?= $form->field($model, 'username')
							->textInput(['placeholder'=>'Email', 'autocomplete'=>'off', 'class'=>'form-control']) ?>
                    </div>
                    <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <?= $form->field($model, 'password')
							->passwordInput(['placeholder'=>$model->getAttributeLabel('password'), 'autocomplete'=>'off']) ?>

                    </div>

                      <div class="checkbox">
				            <?= $form->field($model, 'rememberMe')->checkbox(['value'=>true]) ?>         
				        </div>
				                                
				        <div class="row">
				            <div class="col-md-10 col-md-offset-1">
				                <!-- <button type="submit" class="btn-u btn-block">Log In</button> -->
				                 <?= Html::submitButton(
								UserManagementModule::t('front', 'Login'),
								['class' => 'btn-u btn-block']
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
                 <?php ActiveForm::end(); ?>

    </div>
    <!--End Reg Block-->
</div><!--/container-->
<!--=== End Content Part ===-->
<script type="text/javascript" src="assets_nw/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  $('.form-group.field-loginform-username.required').css("margin-top", "-10px");
	  $('.form-group.field-loginform-password.required').css("margin-top", "-10px");


	}); 
</script>
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

    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b>Login</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <!-- <form action="../../index2.html" method="post"> -->
            <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options'=>['autocomplete'=>'off', 'class'=>'reg-page'],
                        'validateOnBlur'=>false,
                        'fieldConfig' => [
                            'template'=>"{input}\n{error}",
                        ],
                    ]) ?>
          <div class="form-group has-feedback">
            <!-- <input type="email" class="form-control" placeholder="Email"> -->
            <?= $form->field($model, 'username')
                            ->textInput(['placeholder'=>$model->getAttributeLabel('username'), 'autocomplete'=>'off', 'class'=>'form-control']) ?>
              
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <!-- <input type="password" class="form-control" placeholder="Password"> -->
             <?= $form->field($model, 'password')
                            ->passwordInput(['placeholder'=>$model->getAttributeLabel('password'), 'autocomplete'=>'off']) ?>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                   <?= $form->field($model, 'rememberMe')->checkbox(['value'=>true]) ?>
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
               <?= Html::submitButton(
                                UserManagementModule::t('front', 'Login'),
                                ['class' => 'btn-success pull-right']
                            ) ?>
            </div><!-- /.col -->
          </div>
            <?php ActiveForm::end(); ?>

       <!--  <div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div> -->
        <!-- /.social-auth-links -->

       <!--  <?= GhostHtml::a(UserManagementModule::t('front', "I forgot my password"),
                                ['/user-management/auth/password-recovery']
                            ) ?><br> -->
       <!-- <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/registration">Register a new membership</a> -->

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

<script type="text/javascript" src="assets_nw/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
	  $('.form-group.field-loginform-username.required').css("margin-top", "-10px");
	  $('.form-group.field-loginform-password.required').css("margin-top", "-10px");


	}); 
</script>
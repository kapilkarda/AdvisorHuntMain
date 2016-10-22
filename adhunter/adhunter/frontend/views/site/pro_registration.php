<?php
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
    use webvimark\modules\UserManagement\models\User;
    use webvimark\modules\UserManagement\UserManagementModule;
    use Yii;
?>
<!--=== Content Part ===-->    
<div class="container">
    <!--Reg Block-->
    <div class="reg-block">
        <div class="reg-block-header">
            <h2> Pro Sign Up</h2>
           <!--  <ul class="social-icons text-center">
                <li><a class="rounded-x social_facebook" data-original-title="Facebook" href="#"></a></li>
                <li><a class="rounded-x social_twitter" data-original-title="Twitter" href="#"></a></li>
                <li><a class="rounded-x social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                <li><a class="rounded-x social_linkedin" data-original-title="Linkedin" href="#"></a></li>
            </ul> -->
            <p>Already Signed Up? Click <a class="color-green" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=site/prologin">Sign In</a> to login your account.</p>
        </div>

                    <?php $form = ActiveForm::begin([
                        'options'=>['autocomplete'=>'off', 'class'=>''],
                        'id'=>'user',
                        'layout'=>'horizontal',
                        'validateOnBlur'=>false,
                    ]); ?>

                     <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <!-- <input type="text" class="form-control" placeholder="Email"> -->
                        <?= $form->field($model, 'username')->textInput([ 'autocomplete'=>'off', 'autofocus'=>true, 'placeholder'=>'Email', 'class'=>'form-control margin-bottom-20'])->label(false) ?>
                   
                    </div>
                       <div class="input-group margin-bottom-20">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                         <?= $form->field($model, 'password')->passwordInput([ 'autocomplete'=>'off', 'autofocus'=>true, 'placeholder'=>'Password', 'class'=>'form-control margin-bottom-20'])->label(false) ?>
                   
                    </div>
                    <div class="input-group margin-bottom-30">
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                          <?= $form->field($model, 'repeat_password')->passwordInput([ 'autocomplete'=>'off', 'autofocus'=>true, 'placeholder'=>'Confirm Password', 'class'=>'form-control margin-bottom-20'])->label(false) ?>
                   
                    </div>
                    <?php echo Html::hiddenInput('prosignup', 1);?>
                    <hr>

                   <div class="checkbox">            
                        <label>
                            <input type="checkbox"> 
                            I read <a target="_blank" href="#">Terms and Conditions</a>
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <!-- <button type="submit" class="btn-u btn-block">Register</button>    -->
                            <?= Html::submitButton('Register', ['class' => 'btn-u btn-block']) ?>
                                        
                        </div>
                    </div>

                <?php ActiveForm::end(); ?>
    </div>
    <!--End Reg Block-->
</div><!--/container-->
<script type="text/javascript" src="assets_nw/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

             $('.form-group.field-registrationform-username.required > div').removeClass('col-sm-6').removeClass('col-sm-offset-3');
             $('.form-group.field-registrationform-username.required > div').addClass('col-sm-12');

             $('.form-group.field-registrationform-password.required > div').removeClass('col-sm-6').removeClass('col-sm-offset-3');
             $('.form-group.field-registrationform-password.required > div').addClass('col-sm-12');

            $('.form-group.field-registrationform-repeat_password.required > div').removeClass('col-sm-6').removeClass('col-sm-offset-3');
            $('.form-group.field-registrationform-repeat_password.required > div').addClass('col-sm-12');

    }); 
</script>
<style type="text/css">
    .form-group{
        margin-bottom: 0px;
    }
</style>
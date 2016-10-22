<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm $model
 */

$this->title = UserManagementModule::t('front', 'Password recovery');
$this->params['breadcrumbs'][] = $this->title;
?>


    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Password Recovery</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li class="active">Password Recovery</li>
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

				<?= $form->field($model, 'email')->textInput(['maxlength' => 255, 'autofocus'=>true]) ?>

				<?= $form->field($model, 'captcha')->widget(Captcha::className(), [
					'template' => '<div class="row"><div class="col-sm-5">{image}</div><div class="col-sm-7">{input}</div></div>',
					'captchaAction'=>['/user-management/auth/captcha']
				]) ?>

				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<?= Html::submitButton(
							'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('front', 'Recover'),
							['class' => 'btn-u']
						) ?>
					</div>
				</div>

				<?php ActiveForm::end(); ?>

            </div>
        </div>
    </div><!--/container-->
    <!--=== End Content Part ===-->

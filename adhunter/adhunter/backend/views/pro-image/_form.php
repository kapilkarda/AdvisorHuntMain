<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Project;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\User;
/* @var $this yii\web\View */
/* @var $model backend\models\Proimage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proimage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::activeDropDownList($model, 'fk_i_pro_user_id',
       ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control']) ?>

    <?= $form->field($model, 'fk_i_project_id')->textInput() ?>

    <?= $form->field($model, 's_image_type')
    ->dropDownList(
            array('0' =>'Past Project', '1'=>'Profile', '2'=>'Invoice'),         
            ['prompt'=>'Select Image Type']  
    		);?>

    <?//= $form->field($model, 's_image')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'file')->fileInput(['skipOnEmpty' => true, 'accept' => 'image/*',]) ?>

    <?= $form->field($model, 's_image_alt_details')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'd_upload_date')->textInput() ?>

    <?= $form->field($model, 'b_status')
    	->dropDownList(
            array('1'=>'Active', '0'=>'Deactive'),         
            ['prompt'=>'Select Status']  
    		);	?>

    <?//= $form->field($model, 'dt_deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

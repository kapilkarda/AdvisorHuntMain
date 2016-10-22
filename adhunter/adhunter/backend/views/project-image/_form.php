<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use kartik\date\DatePicker;
use backend\models\Project;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\projectimage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectimage-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?//= $form->field($model, 'fk_i_project_id')->textInput() ?>
     <label class="control-label">Project ID</label>
    <?= Html::activeDropDownList($model, 'fk_i_project_id',
       ArrayHelper::map(Project::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 'pk_i_id'), ['class' => 'form-control']) ?>

    <?//= $form->field($model, 'fk_uploaded_by_id')->textInput() ?>
     <label class="control-label">User</label>
    <?= Html::activeDropDownList($model, 'fk_uploaded_by_id',
       ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control']) ?>

    <?= $form->field($model, 's_image_alt_details')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 's_image')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'file')->fileInput(['skipOnEmpty' => true, 'accept' => 'image/*',]) ?>

    <?//= $form->field($model, 'b_status')->textInput() ?>

     <?=  $form->field($model, 'b_status')
        ->dropDownList(
            array('1'=>'Active', '0'=>'Deactive'),         
            ['prompt'=>'Select Status']    
        ); ?>
    
    <?//= $form->field($model, 'd_upload_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

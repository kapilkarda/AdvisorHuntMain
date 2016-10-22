<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\EmailTemplates;
use backend\models\Country;
use backend\models\City;
use backend\models\State;
use backend\models\Zipcode;
use kartik\typeahead\TypeaheadBasic;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\CampaignEmail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaign-email-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_name')->textInput(['maxlength' => true]) ?>
    
    <label class="control-label">Email Template</label>
    <?= Html::activeDropDownList($model, 'fk_i_template_id',
       ArrayHelper::map(EmailTemplates::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id','s_name'), ['class' => 'form-control']) ?>
	<br>
    <?php echo Html::button('Email Criteria', ['value' => Url::to(['campaignemail/createemailcriteria']), 'title' => 'Email Criteria', 'class' => 'showModalButton btn btn-primary emailcriteria-btn', 'id' => 'emailcriteria-btn']);             
      ?>
      <br><br>
    
    <?= $form->field($model, 's_company_query')->textarea(['id' =>'company_query_txt' ,'rows' => 6, 'readonly' => 1]) ?>

    <?= $form->field($model, 's_user_query')->textarea(['id' => 'user_query_txt','rows' => 6, 'readonly' => 1]) ?>
    
    
    <br>

    <?php // echo $form->field($model, 's_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
        
          yii\bootstrap\Modal::begin([
              'header' => '<h4>Email Criteria</h4>',
              'headerOptions' => ['id' => 'modalHeader'],
              'id' => 'emailcriteria-modal',
              'size' => 'modal-md',
              //keeps from closing modal with esc key or by clicking out of the modal.
              // user must click cancel or X to close
              'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
          ]);
          echo "<div id='emailcriteria-modal-content'></div>";
          yii\bootstrap\Modal::end();
    ?>

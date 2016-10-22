<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\PhoneTextTemplate;
use backend\models\Country;
use backend\models\City;
use backend\models\State;
use backend\models\Zipcode;
use kartik\typeahead\TypeaheadBasic;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Campaignphonetext */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaignphonetext-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_name')->textInput(['maxlength' => true]) ?>
    
    <label class="control-label">Email Template</label>
    <?= Html::activeDropDownList($model, 'fk_i_template_id',
       ArrayHelper::map(PhoneTextTemplate::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id','s_name'), ['class' => 'form-control']) ?>
	<br>
	
	 <?php echo Html::button('Phone-Text Campaign Criteria', ['value' => Url::to(['campaignphonetext/createcriteria']), 'title' => 'Phone-Text Campaign Criteria', 'class' => 'showModalButton btn btn-primary textphonecriteria-btn', 'id' => 'textphonecriteria-btn']);             
      ?>
      <br><br>
      
      <?= $form->field($model, 's_company_query')->textarea(['id' =>'company_query_txt' ,'rows' => 6, 'readonly' => 1]) ?>

    <?= $form->field($model, 's_user_query')->textarea(['id' => 'user_query_txt','rows' => 6, 'readonly' => 1]) ?>

    <?= $form->field($model, 's_body')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_status')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'fk_i_template_id')->textInput() ?>

    <?//= $form->field($model, 'dt_deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
        
          yii\bootstrap\Modal::begin([
              'header' => '<h4>Phone-Text Campaign Criteria</h4>',
              'headerOptions' => ['id' => 'modalHeader'],
              'id' => 'criteria-modal',
              'size' => 'modal-md',
              //keeps from closing modal with esc key or by clicking out of the modal.
              // user must click cancel or X to close
              'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
          ]);
          echo "<div id='criteria-modal-content'></div>";
          yii\bootstrap\Modal::end();
    ?>

</div>

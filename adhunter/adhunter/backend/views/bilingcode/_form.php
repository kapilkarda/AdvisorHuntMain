<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\TokenCounts;


/* @var $this yii\web\View */
/* @var $model backend\models\BilingCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biling-code-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php    if(isset($model->i_biling_Code)){ ?>
        <?= $form->field($model, 'i_biling_Code')->textInput(['readonly' => 1]) ?>
       <?php } ?>
     
    <?= $form->field($model, 's_billing_code_details')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'dt_billing_code_start_date')->textInput() ?>
   <?php  echo '<label>Biling Code Start Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_billing_code_start_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_request_renew_date)),
                    'options' => ['placeholder' => 'Select Biling Start date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
    ?> <br>           

    <?//= $form->field($model, 'dt_billing_code_end_date')->textInput() ?>
    
    <?php  echo '<label>Biling Code End Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_billing_code_end_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_request_renew_date)),
                    'options' => ['placeholder' => 'Select Biling End date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
    ?>  <br>          

    <?//= $form->field($model, 'i_token_count_slab1_id')->textInput() ?>
    <label class="control-label">Token Count Slab1</label>
    <?=Html::activeDropDownList($model, 'i_token_count_slab1_id',
       ArrayHelper::map(TokenCounts::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 's_token_count_slab'), ['class' => 'form-control']) ?>
   

    <?//= $form->field($model, 'i_token_count_slab2_id')->textInput() ?>
     <label class="control-label">Token Count Slab2</label>
    <?=Html::activeDropDownList($model, 'i_token_count_slab2_id',
       ArrayHelper::map(TokenCounts::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 's_token_count_slab'), ['class' => 'form-control']) ?>
    

    <?//= $form->field($model, 'i_token_count_slab3_id')->textInput() ?>
     <label class="control-label">Token Count Slab3</label>
    <?=Html::activeDropDownList($model, 'i_token_count_slab3_id',
       ArrayHelper::map(TokenCounts::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 's_token_count_slab'), ['class' => 'form-control']) ?><br>
       
  
    <?= $form->field($model, 'i_default_billing')->checkBox()?>
	
    <?= $form->field($model, 's_discounts')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

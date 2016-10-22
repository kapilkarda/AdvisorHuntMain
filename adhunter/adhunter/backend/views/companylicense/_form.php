<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Company;
use backend\models\State;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyLicense */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-license-form">

    <?php $form = ActiveForm::begin(['id'=>'company-license-form']); ?>

      <?php 
        if(isset($model->fk_i_company_id)){

           echo $form->field($model, 'fk_i_company_id')->hiddenInput()->label('');
           ?><h4 class="control-label"><?php echo Company::findOne($model->fk_i_company_id)->name;?></h4><br><?php
        }else{        
        ?><label class="control-label">Company</label>
        <?= Html::activeDropDownList($model, 'fk_i_company_id',
          ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
        <br><?php
        }
    ?>

    <label class="control-label">State</label>
    <?= Html::activeDropDownList($model, 'fk_i_state_id',
      ArrayHelper::map(State::find()->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

    <?= $form->field($model, 's_accreditation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_accreditation_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_license_details')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'dt_expiration')->textInput() ?>
    <?php echo '<label>Expiration Date</label>';
                echo DatePicker::widget([
                     'name' => 'dt_expiration',
                     'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_expiration)),
                    'options' => ['placeholder' => 'Select Expiration date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
    ?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(function(){

        $('form#company-license-form').on('beforeSubmit',function () {
         var form = $(this);
         // return false if form still have some validation errors
         if (form.find('.has-error').length) {
              return false;
         }
         // submit form
             $.ajax({
                  url: form.attr('action'),
                  type: 'post',
                  data: form.serialize(),
                  success: function (response) {
                       if(response == 1){
                            // $(form).trigger("reset");
                            alert("Recored Inserted !!!");
                             $.pjax.reload({container : '#company-list'});     
                       }
                       else{
                           console.log("Failed !!!");
                       }
                  }
             });
             return false;
        });
    });       
</script>

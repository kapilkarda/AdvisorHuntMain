<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Company;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\BackgroundCheck */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-check-form">

     <?php $form = ActiveForm::begin([
        'id'=>'background-check-form',
         'options'=>['enctype'=>'multipart/form-data'] // important
    ]);  ?>
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

    <?//= $form->field($model, 'dt_bg_check_date')->textInput() ?>
     <?php echo '<label>Background Check Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_bg_check_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_bg_check_date)),
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?>
                <br>
    <?= $form->field($model, 's_bg_check_agency')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 's_bg_check_report_image')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'imagei')->fileInput(['skipOnEmpty' => true, 'accept' => 'image/*',])?>

    <?//= $form->field($model, 'i_bg_check_status')->textInput() ?>


     <?=  $form->field($model, 'i_bg_check_status')
        ->dropDownList(
            array('1'=>'Received', '2'=>'In-Review', '3'=>'Approved'),         
            ['prompt'=>'Select Status']    // options
        ); ?>

    <?= $form->field($model, 's_bg_check_comments')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 's_bg_check_validity')->textInput(['maxlength' => true]) ?>

     <?php echo '<label>Background Check Validity Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 's_bg_check_validity',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_bg_check_date)),
                    'options' => ['placeholder' => 'Select Validity ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?>
        <br>        
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(function(){
        $('form#background-check-form').on('beforeSubmit',function () {
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
                           console.log(response);
                       }
                  }
             });
             return false;
        });
    });       
</script>
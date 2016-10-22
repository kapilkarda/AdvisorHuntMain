<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Company;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyServiceArea */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-service-area-form">

    <?php $form = ActiveForm::begin(['id' => 'company-service-area-form']); ?>
	<?php 
		if(isset($model->fk_i_company_id)){

			 echo $form->field($model, 'fk_i_company_id')->hiddenInput()->label('');
		}else{
			?><label class="control-label">Company</label><?php
    echo Html::activeDropDownList($model, 'fk_i_company_id',
      ArrayHelper::map(Company::find()->all(), 'id', 'name'), ['class' => 'form-control']); 
		}
	?>
  <br>
    <?= $form->field($model, 'zip')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    $(function(){
        $('form#company-service-area-form').on('beforeSubmit',function () {
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
                  	console.log(response);
                       if(response == 1){
                            // $(form).trigger("reset");
                            alert("Recored Inserted !!!");
                             $.pjax.reload({container : '#company-list'});     
                       }
                       else{
                          alert(response);
                           console.log(response);
                       }
                  }
             });
             return false;
        });
    });       
</script>
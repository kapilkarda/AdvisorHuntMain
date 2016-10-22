<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Subcategory;
use dosamigos\multiselect\MultiSelect;
use yii\helpers\ArrayHelper;
use backend\models\CompanyServices;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyServices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-services-form">
	<?php  

		$subcat = [];
		 $service = CompanyServices::find()
                ->where('fk_i_company_id = :fk_i_company_id', [':fk_i_company_id' => $model->fk_i_company_id])
                ->all();
	// print"<pre>";print_r($serives[0]['fk_i_service_id']);print"<pre>";die("DDDDDDD");
			foreach ($service as $value) {
			 	$subcat[] = $value['fk_i_service_id'];
		 	}
	
	?>
    <?php $form = ActiveForm::begin(['id' => 'company-services-form']); ?>

    <?php 
		if(isset($model->fk_i_company_id)){

			 echo $form->field($model, 'fk_i_company_id')->hiddenInput()->label('');
		}else{
			echo $form->field($model, 'fk_i_company_id')->textInput();
		}
	?>

 

    <?=
	
		 MultiSelect::widget([
		    'id'=>"service",
		    "options" => ['multiple'=>"multiple", ['class' => 'form-control']], // for the actual multiselect
		    'data' => ArrayHelper::map(Subcategory::find()->all(), 'id', 'name'), // data as array
		    'value' => $subcat, // if preselected
		    'name' => 'fk_i_service_id', // name for the form
		    "clientOptions" => 
		        [
		            "includeSelectAllOption" => false,
		            'numberDisplayed' => 2
		        ], 
		]);
	?>
	<br><br>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $(function(){
        $('form#company-services-form').on('beforeSubmit',function () {
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
                           console.log("Failed !!!");
                       }
                  }
             });
             return false;
        });
    });       
</script>
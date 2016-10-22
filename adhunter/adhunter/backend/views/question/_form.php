<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\QuestionType;
use backend\models\Subcategory;
use dosamigos\multiselect\MultiSelect;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>


	<?php  
	$subcat = [];
	 foreach ($model->subcategory as $value) {
	 	$subcat[] = $value['id'];
	 }
	?>
    <?php $form = ActiveForm::begin(
          [
            
            'options' => [
                'role' => 'form'
             ]
        ]
    ); ?>
<div class="question-form box-body ">
	<b>Select Sub Category :</b>
    <br><br>
	<?=
	
		 MultiSelect::widget([
		    'id'=>"subcategory",
		    "options" => ['multiple'=>"multiple", ['class' => 'form-control']], // for the actual multiselect
		    'data' => ArrayHelper::map(Subcategory::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), // data as array
		    'value' => $subcat, // if preselected
		    'name' => 'subcategory_id', // name for the form
		    "clientOptions" => 
		        [
		            "includeSelectAllOption" => false,
		            'numberDisplayed' => 2
		        ], 
                 

		]);
	?>


	 <br><br>

    <b>Select Question Type:</b><br><br>
    <?= Html::activeDropDownList($model, 'question_type_id', 
      	ArrayHelper::map(QuestionType::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?> 
    <br><br>

    <?= $form->field($model, 'question_text')->textInput(['maxlength' => true]) ?>

    <div class="" id="question-options" style="margin-bottom: 8px">
    <h3>Enter Options:</h3>
    <?php
    // echo"<pre>";print_r($model->answers[0]); echo"</pre>";
    	for ($i=0; $i < 8; $i++) { 
    		if(isset($model->answers[$i])){
    			$answermodel->answer_text = $model->answers[$i]['answer_text'];
    			?><label>Option </label> <?php echo $i+1;
                 if($model->answers[$i]->dependent_question_id !== null){
                        echo ' (<a href='. Yii::$app->getUrlManager()->getBaseUrl().'/index.php?r=question/view&id='.$model->answers[$i]->dependent_question_id.'>See Dependent Question </a>)';
                 }              
    			echo Html::input('text', 'answer_text[]', $answermodel->answer_text, ['class' => 'form-control ']) ;
    	  		// echo $form->field($answermodel, 'answer_text[]')->textInput(['maxlength' => true])->label('Option '.$i);
    		}
    		else{

				?><label>Option <?php echo $i+1;?></label>
                <?php 
    			echo Html::input('text', 'answer_text[]', '', ['class' => 'form-control']) ;
    		}
    			
    	}
        if(isset($_GET['option_id'])){
            echo Html::hiddenInput('option_id', $_GET['option_id']);
        }
    		
    ?>
    </div>

    <br>
<!--     <div class="row" id="question-date-range" style="margin-bottom: 8px">
        <div class="col-sm-6">
            <?=
            DateTimePicker::widget([
                'name' => 'dates[]',
                'options' => ['placeholder' => 'Start Date...'],
                'pluginOptions' => ['autoclose' => true, 'format' => 'mm/dd/yyyy',  'todayHighlight' => true]
            ]); ?>
        </div>
        <div class="col-sm-6">
            <?=
            DateTimePicker::widget([
                'name' => 'dates[]',
                'options' => ['placeholder' => 'End Date...'],
                'pluginOptions' => ['autoclose' => true, 'format' => 'mm/dd/yyyy']
            ]); ?>
        </div>
    </div> -->


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>
        

<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#question-date-range').hide();
         if($('#question-question_type_id').val() == 3){
                $('#question-date-range').hide();
                $('#question-options').hide();
           }
         if($('#question-question_type_id').val() == 5){
                $('#question-date-range').show();
                $('#question-options').hide();
           }
        $('#question-question_type_id').change(function(){
           console.log($(this).val()); 
           if($(this).val() == 5){
                $('#question-date-range').show();
                $('#question-options').hide();
           }
           if($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 4){
                $('#question-date-range').hide();
                $('#question-options').show();
           }
            if($(this).val() == 3){
                $('#question-date-range').hide();
                $('#question-options').hide();
           }
        });
    });

</script>
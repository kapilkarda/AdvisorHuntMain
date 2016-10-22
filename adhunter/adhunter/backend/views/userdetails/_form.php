<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use backend\models\Country;
use backend\models\State;
use backend\models\City;
use kartik\typeahead\TypeaheadBasic;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Zipcode;
use dosamigos\multiselect\MultiSelect;


/* @var $this yii\web\View */
/* @var $model backend\models\UserDetails */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
  if(!$model->isNewRecord){
        $model->city = City::findOne($model->id)->name;
        $model->zip = Zipcode::findOne($model->zip_id)->zip;
    }
?>
<div class="user-details-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <?//= $form->field($model, 'user_id')->textInput() ?>
    <div class="form-group field-userdetails-user_id ">
        <label class="control-label" for="userdetails-user_id">User</label>
        <?= Html::activeDropDownList($model, 'user_id',
           ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control']) ?>   
        <div class="help-block"></div>
    </div>
  
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagei')->fileInput(['skipOnEmpty' => true, 'accept' => 'image/*',])?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'mobile')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>
    
    <?//= $form->field($model, 'zip')->widget(TypeaheadBasic::classname(), [
	// 		'data' => ArrayHelper::map(zipcode::find()->where('dt_deleted_at IS NULL')->all(), 'id','zip'),
	// 		'language'=>'en',
	// 		'options' => ['placeholder' => 'Select a Zip...','id'=>'zipcode'],
	// 		'pluginOptions' =>[
	// 				'allowClear' => true
	// 		],
	// ])	

	?>

	<?//  echo $form->field($model, 'city')->widget(TypeaheadBasic::classname(), [
	    //    'data' => ArrayHelper::map(City::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'),
	     //   'options' => ['placeholder' => 'Type City name'],
	    //    'pluginOptions' => ['highlight'=>true],
	   // ]); 
	?>

         <!-- <label class="control-label">State</label> -->
    <?//= Html::activeDropDownList($model, 'state_id',
    //  ArrayHelper::map(State::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
        
    <?//= $form->field($model, 'country_id')->textInput() ?>
	 
    <?= $form->field($model, 'zip')->textInput() ?>

    <?php if($model->city_id == '') {?>
        <?= $form->field($model, 'city_id')->dropDownList(['','Enter zip to get the City']) ?>
    <?php } else { ?>
         <label class="control-label">City</label>
        <?= Html::activeDropDownList($model, 'city_id',
          ArrayHelper::map(City::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <?php } ?>
    <br>
    <?php if($model->state_id == '') {?>
            <?= $form->field($model, 'state_id')->dropDownList(['','Enter zip to get the state']) ?>
    <?php } else { ?>
         <label class="control-label">State</label>
        <?= Html::activeDropDownList($model, 'state_id',
          ArrayHelper::map(State::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <?php } ?>
    <br>
    
    <label class="control-label">Country</label>
    <?= Html::activeDropDownList($model, 'country_id',
      ArrayHelper::map(Country::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>



    <?= $form->field($model, 'dynamic1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dynamic2')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
//Javascript to populate city and state
$('#userdetails-zip').change(function(){
		var Zipid = $(this).val();
		$.get('index.php?r=userdetails/city-state-ajax',{zipcode : Zipid},function(data){
		     data = JSON.parse(data);  
              var option = document.getElementById("userdetails-state_id").options[0];
                    option.selected = true;  
                    option.value = data.state_id;
                    option.text = data.state_name;
                var option2 = document.getElementById("userdetails-city_id").options[0];
                    option2.selected = true;  
                    option2.value = data.city_id;
                    option2.text = data.city_name;	
		});		
});

JS;
$this->registerJs($script);
?>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Country;
use backend\models\City;
use backend\models\State;
use backend\models\Zipcode;
use webvimark\modules\UserManagement\models\User;
use kartik\typeahead\TypeaheadBasic;
use backend\models\Subcategory;
use dosamigos\multiselect\MultiSelect;
 
// Usage with ActiveForm and model (with search term highlighting)

/* @var $this yii\web\View */
/* @var $model backend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>
<?php  

    if(!$model->isNewRecord){
        $model->city = City::findOne($model->city_id)->name;
        $model->zip = Zipcode::findOne($model->zip_id)->zip;
    }
    $subcat = [];
     foreach ($model->subcategory as $value) {
        $subcat[] = $value['id'];
     }
    ?>
<div class="company-form">
    <?php $form = ActiveForm::begin([
         'options'=>['enctype'=>'multipart/form-data'] // important
    ]);  ?>

  <label class="control-label">User</label>
    <?= Html::activeDropDownList($model, 'user_id',
       ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control']) ?>
    <br>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_alert_flag')->checkBox() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>
    
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
    
    <?//=
    // Usage with ActiveForm and model (with search term highlighting)
    // $form->field($model, 'city')->widget(TypeaheadBasic::classname(), [
    //    'data' => ArrayHelper::map(City::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'),
    //    'options' => ['placeholder' => 'Type City name'],
    //    'pluginOptions' => ['highlight'=>true],
    // ]); 
    ?>

     <!-- <label class="control-label">State</label> -->
    <?//= Html::activeDropDownList($model, 'state_id',
     // ArrayHelper::map(State::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    
     <label class="control-label">Country</label>
    <?= Html::activeDropDownList($model, 'country_id',
      ArrayHelper::map(Country::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>



    <label class="control-label">Services</label>
    <br>
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
    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'year_founded')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput(['skipOnEmpty' => true, 'accept' => 'image/*',])?>

    <?= $form->field($model, 'ibanner')->fileInput(['skipOnEmpty' => true, 'accept' => 'image/*',]) ?>
    
    <?= $form->field($model, 'invoice_logoi')->fileInput(['skipOnEmpty' => true, 'accept' => 'image/*',]) ?>


    <?//= $form->field($model, 'notification_to_email')->textInput() ?>
    
    <?= $form->field($model, 'closed_company_flag')->checkBox() ?>

    <?= $form->field($model, 'active_company_flag')->checkBox() ?>

    <?= $form->field($model, 'company_claimed')->checkBox(['maxlength' => true]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$script = <<< JS
//Javascript to populate city and state

$('#company-zip').change(function(){
        var Zipid = $(this).val();
        $.get('index.php?r=userdetails/city-state-ajax',{zipcode : Zipid},function(data){
            data = JSON.parse(data);  
            console.log(data);
            var option = document.getElementById("company-state_id").options[0];
                    option.selected = true;  
                    option.value = data.state_id;
                    option.text = data.state_name;
            var option1 = document.getElementById("company-city_id").options[0];
                    option1.selected = true;  
                    option1.value = data.city_id;
                    option1.text = data.city_name;   
        });     
});

JS;
$this->registerJs($script);
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             
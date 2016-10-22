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
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\Lead */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
  if(!$model->isNewRecord){
        $model->city = City::findOne($model->fk_i_city_id)->name;
        $model->zip = Zipcode::findOne($model->fk_i_zip_id)->zip;
    }
?>
<div class="lead-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_name')->textInput(['maxlength' => true]) ?>

     <label class="control-label">Sub Category</label>
    <?= Html::activeDropDownList($model, 'fk_i_sub_category_id',
      ArrayHelper::map(Subcategory::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

    <?= $form->field($model, 's_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_address1')->textInput(['maxlength' => true]) ?>

      <label class="control-label">Country</label>
    <?= Html::activeDropDownList($model, 'fk_i_country_id',
      ArrayHelper::map(Country::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

     <label class="control-label">State</label>
    <?= Html::activeDropDownList($model, 'fk_i_state_id',
      ArrayHelper::map(State::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

    <?php
    // Usage with ActiveForm and model (with search term highlighting)
    echo $form->field($model, 'city')->widget(TypeaheadBasic::classname(), [
        'data' => ArrayHelper::map(City::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Type City name'],
        'pluginOptions' => ['highlight'=>true],
    ]); 
    ?>

    <?= $form->field($model, 'zip')->textInput() ?>

    <?= $form->field($model, 's_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_ip_address')->textInput(['maxlength' => true]) ?>


     <?=  $form->field($model, 'i_status')
        ->dropDownList(
            array('1'=>'Requested', '2'=>'In Progress', '3'=>'Completed'),         
            ['prompt'=>'Select Status']    // options
        ); ?>

       <label class="control-label">User</label>
    <?= Html::activeDropDownList($model, 'fk_i_requested_by',
        ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.email FROM user as u, auth_assignment as role  WHERE u.id = role.user_id AND role.item_name = "Customer" AND u.dt_deleted_at IS NULL')->queryAll(), 'id', 'email'), ['class' => 'form-control']) ?>
  
        <!-- ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control'])  -->
    <br>
         <?php // usage without model
                echo '<label>Request Completed Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_request_complete_date',
                     'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_request_complete_date)),
                    'options' => ['placeholder' => 'Select Request date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        //'maxDate'=> '+40y',
                        'todayHighlight' => true
                    ]
                ]);
        ?>
    <br>

    <?= $form->field($model, 'i_request_renewed_count')->textInput() ?>

     <?php // usage without model
                echo '<label>Request Renewal Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_request_renew_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_request_renew_date)),
                    'options' => ['placeholder' => 'Select Renewal date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
        ?>

    <?php //echo $form->field($model, 'dt_request_renew_date')->textInput() ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;
use backend\models\BilingCode;
use kartik\date\DatePicker;
use kartik\typeahead\TypeaheadBasic;

/* @var $this yii\web\View */
/* @var $model backend\models\referral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referral-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_referral_details')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'i_referral_status')->textInput() ?>
    <?=  $form->field($model, 'i_referral_status')->dropDownList(
            array('0'=>'Sent', '1'=>'Signedup'),         
            ['prompt'=>'Select Status']    // options
        ); ?>

    <?//= $form->field($model, 'fk_i_requested_user_id')->textInput() ?>
    
     <label class="control-label">User</label>
    <?= Html::activeDropDownList($model, 'fk_i_requested_user_id',
       ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control']) ?>
    <br>
    

    <?= $form->field($model, 's_referral_sent_to_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_referral_sent_to_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_referral_sent_to_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_referral_sent_to_message')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'dt_referral_sent_date')->textInput() ?>
    <?php echo '<label>Referral Sent Date</label>';
                echo DatePicker::widget([
                     'name' => 'dt_referral_sent_date',
                     'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_expiration)),
                    'options' => ['placeholder' => 'Select Referral Sent date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
    ?>
    <br>

    <?= $form->field($model, 'i_referral_rminder_count')->textInput() ?>

    <?//= $form->field($model, 'dt_last_reminder_date')->textInput() ?>
    <?php echo '<label>Referral Reminder Date</label>';
                echo DatePicker::widget([
                     'name' => 'dt_last_reminder_date',
                     'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_expiration)),
                    'options' => ['placeholder' => 'Select Last Reminder date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
    ?>
    <br>

    <?//= $form->field($model, 'fk_i_referral_billing_code')->textInput() ?>
    <label class="control-label">Billing Code</label>
    <?= Html::activeDropDownList($model, 'fk_i_referral_billing_code',
       ArrayHelper::map(BilingCode::find()->all(), 'pk_i_id', 'i_biling_Code'), ['class' => 'form-control']) ?>
    <br>
    
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

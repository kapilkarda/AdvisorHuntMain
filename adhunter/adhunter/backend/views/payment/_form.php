<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\PurchaseOrder;
use backend\models\CustomerInvoice;
use webvimark\modules\UserManagement\models\User;
use backend\models\Company;

/* @var $this yii\web\View */
/* @var $model backend\models\payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'fk_i_purchase_order_id')->textInput() ?>
     <label class="control-label">PO ID</label>
    <?=Html::activeDropDownList($model, 'fk_i_purchase_order_id',
       ArrayHelper::map(PurchaseOrder::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 'pk_i_id'), ['class' => 'form-control']) ?>

    <?//= $form->field($model, 'fk_i_invoice_id')->textInput() ?>
    <label class="control-label">Invoiuce ID</label>
    <?=Html::activeDropDownList($model, 'fk_i_invoice_id',
       ArrayHelper::map(CustomerInvoice::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 'pk_i_id'), ['class' => 'form-control']) ?>

    <?//= $form->field($model, 's_payment_type')->textInput(['maxlength' => true]) ?>
    <?=  $form->field($model, 's_payment_type')
        ->dropDownList(
            array('1'=>'Credit/Debit Card', '2'=>'Check', '3'=>'Cash'),         
            ['prompt'=>'Select Payment Type']    // options
        ); ?>
     
    <?//= $form->field($model, 'fk_i_user_id')->textInput() ?>
    <label class="control-label">Comapny</label>
    <?= Html::activeDropDownList($model, 'fk_i_user_id',
       ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

    <?= $form->field($model, 'f_amount')->textInput() ?>

    <?//= $form->field($model, 'b_payments_successful')->textInput() ?>
     <?=  $form->field($model, 'b_payments_successful')
        ->dropDownList(
            array('1'=>'Pending', '2'=>'Paid'),         
            ['prompt'=>'Select Payment Status']    // options
        ); ?>

    <?= $form->field($model, 's_payment_ip')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'dt_created_at')->textInput() ?>
    <?php // usage without model
                echo '<label>Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_created_at',
                     'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_request_complete_date)),
                    'options' => ['placeholder' => 'Select Date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        //'maxDate'=> '+40y',
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

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;
use backend\models\Company;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\customerinvoice */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customerinvoice-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'fk_i_company_id')->textInput() ?>
    <label class="control-label">Company</label>
    <?= Html::activeDropDownList($model, 'fk_i_company_id',
      ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>
        
    <?//= $form->field($model, 'fk_i_user_id')->textInput() ?>
     <label class="control-label">User</label>
    <?= Html::activeDropDownList($model, 'fk_i_user_id',
       ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control']) ?>
    <br>
        
    <?= $form->field($model, 's_memo')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'dt_invoice_date')->textInput() ?>
     <?php echo '<label>Invoice Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_invoice_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_bg_check_date)),
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?>

    <?= $form->field($model, 'i_invoice_tot_amt')->textInput() ?>

    <?= $form->field($model, 'f_invoice_paid_amt')->textInput() ?>

    <?= $form->field($model, 'f_invoice_due_amt')->textInput() ?>

    <?//= $form->field($model, 'dt_paid_date')->textInput() ?>
     <?php echo '<label>Paid On Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_paid_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_bg_check_date)),
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);?><br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

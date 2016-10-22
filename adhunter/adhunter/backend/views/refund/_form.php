<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Company;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\Bid;
use backend\models\Lead;
use webvimark\modules\UserManagement\models\User;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Refund */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refund-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo $form->field($model, 'fk_i_project_id')->textInput() ?>

     <label class="control-label">Lead</label>
    <?= Html::activeDropDownList($model, 'fk_i_project_id',
      ArrayHelper::map(Lead::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 's_name'), ['class' => 'form-control']) ?>
    <br>

    <label class="control-label">Company</label>
    <?= Html::activeDropDownList($model, 'fk_i_pro_id',
      ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

     <label class="control-label">Bid</label>
    <?= Html::activeDropDownList($model, 'fk_i_bid_id',
      ArrayHelper::map(Bid::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 'pk_i_id'), ['class' => 'form-control']) ?>
    <br>


    <?php //echo $form->field($model, 'fk_i_bid_id')->textInput() ?>

    <?= $form->field($model, 's_description')->textInput(['maxlength' => true]) ?>


     <?php
     echo '<label>Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_bg_check_date)),
                    'options' => ['placeholder' => 'Select date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
    ?>
    <br>

    <?php // echo $form->field($model, 's_refund_processed_by')->textInput(['maxlength' => true]) ?>

     <label class="control-label">Processed By </label>
    <?= Html::activeDropDownList($model, 's_refund_processed_by',
      ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control']) ?>
    <br>

     <?=  $form->field($model, 'i_refund_status')
        ->dropDownList(
            array('1'=>'Requested', '2'=>'Canceled', '3'=>'Refunded'),           // Flat array ('id'=>'label')
            ['prompt'=>'Select Status']    // options
        ); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

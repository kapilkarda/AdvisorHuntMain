<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use backend\models\Lead;
use backend\models\Company;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Bid */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bid-form">

    <?php $form = ActiveForm::begin(); ?>

    
    <label class="control-label">Lead</label>
    <?= Html::activeDropDownList($model, 'fk_i_lead_id',
      ArrayHelper::map(Lead::find()->all(), 'pk_i_id', 's_name'), ['class' => 'form-control']) ?>
    <br>
        <label class="control-label">Company</label>
    <?= Html::activeDropDownList($model, 'fk_i_user_id',
      ArrayHelper::map(Company::find()->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>


    <!-- <?= $form->field($model, 'fk_i_user_id')->textInput() ?> -->

    <?= $form->field($model, 's_ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_i_token_used_id')->textInput() ?>

    <?=  $form->field($model, 'i_status')
        ->dropDownList(
            array('1'=>'Requested', '2'=>'Passed', '3'=>'Accepted', '4'=>'Blocked'),           // Flat array ('id'=>'label')
            ['prompt'=>'Select Status']    // options
        ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

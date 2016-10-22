<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use backend\models\Company;


/* @var $this yii\web\View */
/* @var $model backend\models\TokenBalance */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="token-balance-form">

    <?php $form = ActiveForm::begin(); ?>

    <?//= $form->field($model, 'fk_i_user_id')->textInput() ?>
    <label class="control-label">Company</label>
    <?= Html::activeDropDownList($model, 'fk_i_user_id',
       ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

    <?= $form->field($model, 'i_prev_balance')->textInput() ?>

    <?= $form->field($model, 'i_current_balance')->textInput() ?>

    <?//= $form->field($model, 'dt_last_purchase_date')->textInput() ?>
    <?php echo '<label>Last Purchase Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_last_purchase_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_bg_check_date)),
                    'options' => ['placeholder' => 'Last Purchase Date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true
                    ]
                ]);
    ?>
    <br>
    <?//= $form->field($model, 'dt_last_used_date')->textInput() ?>
   <?php echo '<label>Last Used Date</label>';
                echo DatePicker::widget([
                     'model'=>$model,
                    'name' => 'dt_last_used_date',
                    'value' => date('Y-m-d', strtotime('+0 days')),
                    //'value' => date('Y-M-d', strtotime($model->dt_bg_check_date)),
                    'options' => ['placeholder' => 'Last Used Date ...'],
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
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

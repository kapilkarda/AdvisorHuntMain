<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\PromoCode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promo-code-form">

    <?php $form = ActiveForm::begin(); ?>
	<?php    if(isset($model->i_code)){ ?>
    <?= $form->field($model, 'i_code')->textInput(['readonly' => 1]) ?>
    <?php } ?>

    <?= $form->field($model, 'i_no_of_tokens')->textInput() ?>

    <?//= $form->field($model, 'dt_start_date')->textInput() ?>
     <?php echo '<label>Start Date</label>';
                echo DatePicker::widget([
                     'name' => 'dt_start_date',
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

    <?//= $form->field($model, 'dt_end_date')->textInput() ?>
     <?php echo '<label>End Date</label>';
                echo DatePicker::widget([
                     'name' => 'dt_end_date',
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

    <?//= $form->field($model, 'dt_created_at')->textInput() ?>

    <?//= $form->field($model, 'dt_deleted_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

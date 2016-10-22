<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\LeadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lead-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 's_name') ?>

    <?= $form->field($model, 'fk_i_sub_category_id') ?>

    <?= $form->field($model, 's_address') ?>

    <?= $form->field($model, 's_address1') ?>

    <?php // echo $form->field($model, 'fk_i_city_id') ?>

    <?php // echo $form->field($model, 'fk_i_state_id') ?>

    <?php // echo $form->field($model, 'fk_i_country_id') ?>

    <?php // echo $form->field($model, 'fk_i_zip_id') ?>

    <?php // echo $form->field($model, 's_email') ?>

    <?php // echo $form->field($model, 's_mobile') ?>

    <?php // echo $form->field($model, 's_ip_address') ?>

    <?php // echo $form->field($model, 'i_status') ?>

    <?php // echo $form->field($model, 'fk_i_requested_by') ?>

    <?php // echo $form->field($model, 'dt_date_created') ?>

    <?php // echo $form->field($model, 'dt_request_complete_date') ?>

    <?php // echo $form->field($model, 'i_request_renewed_count') ?>

    <?php // echo $form->field($model, 'dt_request_renew_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

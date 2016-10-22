<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ReferralSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referral-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?//= $form->field($model, 'pk_i_id') ?>

    <?//= $form->field($model, 's_referral_details') ?>

    <?= $form->field($model, 'fk_i_requested_user_id') ?>
    
    <?= $form->field($model, 'i_referral_status') ?>

    <?= $form->field($model, 's_referral_sent_to_name') ?>

    <?php $form->field($model, 's_referral_sent_to_email') ?>

    <?php $form->field($model, 's_referral_sent_to_mobile') ?>

    <?php // echo $form->field($model, 's_referral_sent_to_message') ?>

    <?php $form->field($model, 'dt_referral_sent_date') ?>

    <?php // echo $form->field($model, 'i_referral_rminder_count') ?>

    <?php // echo $form->field($model, 'dt_last_reminder_date') ?>

    <?php // echo $form->field($model, 'fk_i_referral_billing_code') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

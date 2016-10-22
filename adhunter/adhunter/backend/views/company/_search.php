<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'address1') ?>

    <?= $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'state_id') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <?php // echo $form->field($model, 'zip_id') ?>

    <?php // echo $form->field($model, 'about') ?>

    <?php // echo $form->field($model, 'year_founded') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'profile_pic') ?>

    <?php // echo $form->field($model, 'banner') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'mobile_alert_flag') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'notification_to_email') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'active_company_flag') ?>

    <?php // echo $form->field($model, 'company_claimed') ?>

    <?php // echo $form->field($model, 'invoice_logo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

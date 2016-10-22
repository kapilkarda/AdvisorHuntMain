<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PaymentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_purchase_order_id') ?>

    <?= $form->field($model, 'fk_i_invoice_id') ?>

    <?= $form->field($model, 's_payment_type') ?>

    <?= $form->field($model, 'fk_i_user_id') ?>

    <?php // echo $form->field($model, 'f_amount') ?>

    <?php // echo $form->field($model, 'b_payments_successful') ?>

    <?php // echo $form->field($model, 's_payment_ip') ?>

    <?php // echo $form->field($model, 'dt_created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

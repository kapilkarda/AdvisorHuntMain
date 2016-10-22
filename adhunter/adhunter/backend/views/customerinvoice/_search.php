<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerinvoiceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customerinvoice-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_company_id') ?>

    <?= $form->field($model, 'fk_i_user_id') ?>

    <?= $form->field($model, 's_memo') ?>

    <?= $form->field($model, 'dt_invoice_date') ?>

    <?php // echo $form->field($model, 'i_invoice_tot_amt') ?>

    <?php // echo $form->field($model, 'f_invoice_paid_amt') ?>

    <?php // echo $form->field($model, 'f_invoice_due_amt') ?>

    <?php // echo $form->field($model, 'dt_paid_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

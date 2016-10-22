<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BilingCodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="biling-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fk_i_id') ?>

    <?= $form->field($model, 'i_biling_Code') ?>

    <?= $form->field($model, 's_billing_code_details') ?>

    <?= $form->field($model, 'dt_billing_code_start_date') ?>

    <?= $form->field($model, 'dt_billing_code_end_date') ?>

    <?php // echo $form->field($model, 'i_token_count_slab1_id') ?>

    <?php // echo $form->field($model, 'i_token_count_slab2_id') ?>

    <?php // echo $form->field($model, 'i_token_count_slab3_id') ?>

    <?php // echo $form->field($model, 's_discounts') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

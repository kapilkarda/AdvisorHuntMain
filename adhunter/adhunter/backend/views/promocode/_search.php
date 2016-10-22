<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PromoCodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="promo-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'i_code') ?>

    <?= $form->field($model, 'i_no_of_tokens') ?>

    <?= $form->field($model, 'dt_start_date') ?>

    <?= $form->field($model, 'dt_end_date') ?>

    <?php // echo $form->field($model, 'dt_created_at') ?>

    <?php // echo $form->field($model, 'dt_deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

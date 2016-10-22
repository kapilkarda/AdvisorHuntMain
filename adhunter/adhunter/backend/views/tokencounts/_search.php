<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TokenCountsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="token-counts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 's_token_count_slab') ?>

    <?= $form->field($model, 'i_token_count') ?>

    <?= $form->field($model, 'f_price') ?>

    <?= $form->field($model, 's_validity_days') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

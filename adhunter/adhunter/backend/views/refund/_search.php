<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RefundSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="refund-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_project_id') ?>

    <?= $form->field($model, 'fk_i_pro_id') ?>

    <?= $form->field($model, 'fk_i_bid_id') ?>

    <?= $form->field($model, 's_description') ?>

    <?php // echo $form->field($model, 'dt_date') ?>

    <?php // echo $form->field($model, 's_refund_processed_by') ?>

    <?php // echo $form->field($model, 'i_refund_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

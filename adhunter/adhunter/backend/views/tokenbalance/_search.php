<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TokenBalanceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="token-balance-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_user_id') ?>

    <?= $form->field($model, 'i_prev_balance') ?>

    <?= $form->field($model, 'i_current_balance') ?>

    <?= $form->field($model, 'dt_last_purchase_date') ?>

    <?php // echo $form->field($model, 'dt_last_used_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BidSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bid-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_lead_id') ?>

    <?= $form->field($model, 'fk_i_user_id') ?>

    <?= $form->field($model, 's_ip_address') ?>

    <?= $form->field($model, 'fk_i_token_used_id') ?>

    <?php // echo $form->field($model, 'i_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

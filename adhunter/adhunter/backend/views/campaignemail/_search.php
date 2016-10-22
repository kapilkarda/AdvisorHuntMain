<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CampaignEmailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaign-email-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 's_name') ?>

    <?= $form->field($model, 's_query') ?>

    <?= $form->field($model, 's_email_body') ?>

    <?= $form->field($model, 's_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PhoneTextTemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phone-text-template-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 's_name') ?>

    <?= $form->field($model, 'i_template_type') ?>

    <?= $form->field($model, 's_template') ?>

    <?= $form->field($model, 'dt_created_date') ?>

    <?php // echo $form->field($model, 'dt_deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

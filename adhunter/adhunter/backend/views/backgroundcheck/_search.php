<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BackgroundCheckSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="background-check-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_company_id') ?>

    <?= $form->field($model, 'dt_bg_check_date') ?>

    <?= $form->field($model, 's_bg_check_agency') ?>

    <?= $form->field($model, 's_bg_check_report_image') ?>

    <?php // echo $form->field($model, 'i_bg_check_status') ?>

    <?php // echo $form->field($model, 's_bg_check_comments') ?>

    <?php // echo $form->field($model, 's_bg_check_validity') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

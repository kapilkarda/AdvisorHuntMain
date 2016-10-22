<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_requested_by') ?>

    <?= $form->field($model, 's_name') ?>

    <?= $form->field($model, 'i_type') ?>

    <?= $form->field($model, 'f_cost') ?>

    <?php // echo $form->field($model, 's_duration') ?>

    <?php // echo $form->field($model, 's_description') ?>

    <?php // echo $form->field($model, 's_address') ?>

    <?php // echo $form->field($model, 'fk_i_zip_id') ?>

    <?php // echo $form->field($model, 'fk_i_company_id') ?>

    <?php // echo $form->field($model, 'dt_created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

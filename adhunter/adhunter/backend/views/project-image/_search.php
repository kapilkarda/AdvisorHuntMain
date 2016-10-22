<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProjectImageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projectimage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_project_id') ?>

    <?= $form->field($model, 'fk_uploaded_by_id') ?>

    <?= $form->field($model, 's_image_alt_details') ?>

    <?= $form->field($model, 's_image') ?>
    
    <?= $form->field($model, 'd_upload_date') ?>

    <?php // echo $form->field($model, 'b_status') ?>

    <?php // echo $form->field($model, 'dt_deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

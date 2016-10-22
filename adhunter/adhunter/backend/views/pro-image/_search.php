<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProimageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proimage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_pro_user_id') ?>

    <?= $form->field($model, 'fk_i_project_id') ?>

    <?= $form->field($model, 's_image_type') ?>

    <?= $form->field($model, 's_image') ?>

    <?php // echo $form->field($model, 's_image_alt_details') ?>

    <?php // echo $form->field($model, 'd_upload_date') ?>

    <?php // echo $form->field($model, 'b_status') ?>

    <?php // echo $form->field($model, 'dt_deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

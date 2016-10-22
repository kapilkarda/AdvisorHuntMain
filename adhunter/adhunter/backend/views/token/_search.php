<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TokenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="token-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_sub_category_id') ?>

    <?= $form->field($model, 'fk_i_zip_id') ?>

    <?= $form->field($model, 'i_project_cost_range_from') ?>

    <?= $form->field($model, 'i_project_cost_range_to') ?>

    <?php // echo $form->field($model, 'i_token_count') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

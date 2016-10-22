<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TokenCounts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="token-counts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_token_count_slab')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'i_token_count')->textInput() ?>

    <?= $form->field($model, 'f_price')->textInput() ?>

    <?= $form->field($model, 's_validity_days')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

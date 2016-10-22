<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyRating */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-rating-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_i_company_id')->textInput() ?>

    <?= $form->field($model, 's_rating_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'i_rating')->textInput() ?>

    <?= $form->field($model, 's_review_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dt_review_date')->textInput() ?>

      <?= $form->field($model, 'fk_i_comment_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

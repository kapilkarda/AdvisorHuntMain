<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyReviewByExternalCompany */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-review-by-external-company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fk_i_company_id')->textInput() ?>

    <?= $form->field($model, 's_yelp_rating_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_google_rating')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_BBB_ratings')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyRatingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-rating-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_company_id') ?>

    <?= $form->field($model, 's_rating_category') ?>

    <?= $form->field($model, 'i_rating') ?>

    <?= $form->field($model, 's_review_by') ?>

    <?php // echo $form->field($model, 'dt_review_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

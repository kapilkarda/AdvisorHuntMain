<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyReviewCommentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-review-comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 'fk_i_company_id') ?>

    <?= $form->field($model, 's_review_by') ?>

    <?= $form->field($model, 's_review_comment') ?>

    <?= $form->field($model, 'dt_review_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

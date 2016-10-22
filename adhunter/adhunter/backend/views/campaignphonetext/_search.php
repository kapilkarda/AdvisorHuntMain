<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CampaignphonetextSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="campaignphonetext-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pk_i_id') ?>

    <?= $form->field($model, 's_name') ?>

    <?= $form->field($model, 's_user_query') ?>

    <?= $form->field($model, 's_company_query') ?>

    <?= $form->field($model, 's_body') ?>

    <?php // echo $form->field($model, 's_status') ?>

    <?php // echo $form->field($model, 'fk_i_template_id') ?>

    <?php // echo $form->field($model, 'dt_deleted_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

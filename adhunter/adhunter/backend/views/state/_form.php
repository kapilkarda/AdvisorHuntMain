<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Country;


/* @var $this yii\web\View */
/* @var $model backend\models\State */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'short_name')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>


    <!-- <?= $form->field($model, 'country_id')->textInput() ?> -->
    <b>Country</b>
    <?= Html::activeDropDownList($model, 'country_id',
      ArrayHelper::map(Country::find()->all(), 'id', 'name'), ['class' => 'form-control']) ?>
	<br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

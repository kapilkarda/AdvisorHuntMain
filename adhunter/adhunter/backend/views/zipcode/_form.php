<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\City;

/* @var $this yii\web\View */
/* @var $model backend\models\Zipcode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zipcode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'zip')->textInput() ?>

    <?= $form->field($model, 'latitude')->textInput() ?>

    <?= $form->field($model, 'longitude')->textInput() ?>

    <?= $form->field($model, 'timezone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dst')->textInput() ?>

    <!-- <?= $form->field($model, 'city_id')->textInput() ?> -->

     <b>City</b>
    <?= Html::activeDropDownList($model, 'city_id',
      ArrayHelper::map(City::find()->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\EmailTemplates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-templates-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_email_template')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

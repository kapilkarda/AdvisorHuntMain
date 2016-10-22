<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Company;
use backend\models\Project;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyReviewComment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-review-comment-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'fk_i_company_id')->textInput() ?> -->
    <label class="control-label">Company</label>
    <?= Html::activeDropDownList($model, 'fk_i_company_id',
      ArrayHelper::map(Company::find()->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>
     <label class="control-label">User</label>
    <?= Html::activeDropDownList($model, 's_review_by',
      ArrayHelper::map(User::find()->all(), 'id', 'email'), ['class' => 'form-control']) ?>
    <br>

     <label class="control-label">Project</label>
    <?= Html::activeDropDownList($model, 'fk_i_project_id',
      ArrayHelper::map(Project::find()->all(), 'pk_i_id', 's_name'), ['class' => 'form-control']) ?>
    <br>


    <?= $form->field($model, 's_review_comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_status')->checkBox() ?>

    <!-- <?= $form->field($model, 'dt_review_date')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

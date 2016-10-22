<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use webvimark\modules\UserManagement\models\User;
use backend\models\Company;
use yii\helpers\ArrayHelper;
use backend\models\Zipcode;
use backend\models\City;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
 if(!$model->isNewRecord){
        $model->zip = Zipcode::findOne($model->fk_i_zip_id)->zip;
    }
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

<label class="control-label">Requested By</label>
    <?= Html::activeDropDownList($model, 'fk_i_requested_by',
     ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.email FROM user as u, auth_assignment as role  WHERE u.id = role.user_id AND role.item_name = "Customer" AND u.dt_deleted_at IS NULL')->queryAll(), 'id', 'email'), ['class' => 'form-control']) ?>
    <br>

<label class="control-label">Company</label>
    <?= Html::activeDropDownList($model, 'fk_i_company_id',
      ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

    <!-- <?= $form->field($model, 'fk_i_requested_by')->textInput() ?> -->

    <?= $form->field($model, 's_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'i_type')->dropDownList(['1' => 'Residential', '2' => 'Commercial']); ?>

    <?= $form->field($model, 'f_cost')->textInput() ?>

    <?= $form->field($model, 's_duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 's_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 's_address')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'fk_i_zip_id')->textInput() ?>
    <?= $form->field($model, 'zip')->textInput() ?>

    <!-- <?= $form->field($model, 'fk_i_company_id')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

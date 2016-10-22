<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Subcategory;
use yii\helpers\ArrayHelper;
use backend\models\Zipcode;
use backend\models\City;
use backend\models\Country;
use backend\models\State;
use kartik\typeahead\TypeaheadBasic;
/* @var $this yii\web\View */
/* @var $model backend\models\Token */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
if(!$model->isNewRecord){
        $model->zip = Zipcode::findOne($model->fk_i_zip_id)->zip;
    }
?>
<div class="token-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'fk_i_sub_category_id')->textInput() ?> -->
     <b>SubCategory:</b><br><br>
    <?= Html::activeDropDownList($model, 'fk_i_sub_category_id', 
        ArrayHelper::map(SubCategory::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?> 
    <br>
    <label class="control-label">State</label>
    <?= Html::activeDropDownList($model, 'state_id',
      ArrayHelper::map(State::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
    <br>

    <?php
    // Usage with ActiveForm and model (with search term highlighting)
    echo $form->field($model, 'city')->widget(TypeaheadBasic::classname(), [
        'data' => ArrayHelper::map(City::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Type City name'],
        'pluginOptions' => ['highlight'=>true],
    ]); 
    ?>


   


    <?//= $form->field($model, 'fk_i_zip_id')->textInput() ?>
     <?= $form->field($model, 'zip')->textInput() ?>

    <?= $form->field($model, 'i_project_cost_range_from')->textInput() ?>

    <?= $form->field($model, 'i_project_cost_range_to')->textInput() ?>

    <?= $form->field($model, 'i_token_count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

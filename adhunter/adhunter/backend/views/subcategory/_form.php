<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subcategory-form box-body">

    <?php $form = ActiveForm::begin(); ?>
    
    <b>Select Category:</b>
    <?= Html::activeDropDownList($model, 'category_id',
      ArrayHelper::map(Category::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
	<br>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'image')->fileInput(['skipOnEmpty' => true, 'accept' => 'image/*',])?>
    
      <?= $form->field($model, 'b_front_page')->checkBox() ?>
    
    
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
<br><br>
    <?php ActiveForm::end(); ?>

</div>

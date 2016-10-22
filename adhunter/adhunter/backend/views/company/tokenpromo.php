<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Company;
use webvimark\modules\UserManagement\models\User;
use backend\models\PromoCode;
use yii\helpers\ArrayHelper;

$this->title = 'Create Promotional Token';
$this->params['breadcrumbs'][] = ['label' => 'Token Management', 'url' => ['tokenmanagement']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row">
<div class="col-md-4">
</div>
<div class="col-md-4">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">

 <div class="add-promo-token-form">
    <?php $form = ActiveForm::begin([
        'action' => 'index.php?r=company/promotional-token&id='.$model->fk_i_company_id, 
        'options'=>['enctype'=>'multipart/form-data'] // important
    ]);  ?>

    <?php if($model->fk_i_company_id) { 
         echo $form->field($model, 'fk_i_company_id')->hiddenInput()->label('');
           ?><h5 class="control-label"> <b>Company :</b> <?php echo Company::findOne($model->fk_i_company_id)->name;?></h5><?php
        } else{        
        ?><label class="control-label">Company</label>
        <?= Html::activeDropDownList($model, 'fk_i_company_id',
          ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'name'), ['class' => 'form-control']) ?>
        <?php
        }?>

        <?php if($model->fk_i_provided_by) { 
         echo $form->field($model, 'fk_i_provided_by')->hiddenInput()->label('');
           ?><h5 class="control-label"><b>Provided By :</b><?php echo User::findOne($model->fk_i_provided_by)->email;?></h5><?php
        } else{        
        ?><label class="control-label">Provided By</label>
        <?= Html::activeDropDownList($model, 'fk_i_provided_by',
          ArrayHelper::map(User::find()->where('dt_deleted_at IS NULL')->all(), 'id', 'email'), ['class' => 'form-control']) ?>
        <?php
        }?>
        <br>
    <?//= $form->field($model, 'fk_i_company_id')->textInput(['maxlength' => true]) ?>
    <?//= $form->field($model, 'fk_i_provided_by')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'i_no_of_tokens')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'pk_i_promo_id')->textInput(['maxlength' => true]) ?>

    <label class="control-label">Promo Code</label>
        <?= Html::activeDropDownList($model, 'pk_i_promo_id',
          ArrayHelper::map(PromoCode::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 'i_code'), ['class' => 'form-control']) ?>
        <br>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
</div>
</div>
</div>
</section>



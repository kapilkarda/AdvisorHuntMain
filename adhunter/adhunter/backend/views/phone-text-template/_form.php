<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PhoneTextTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phone-text-template-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 's_name')->textInput(['maxlength' => true]) ?>
      
     
     <?=
                    $form->field($model, 'i_template_type')
                        ->radioList(
                            [1 => 'Voice Call Template', 0 => 'Text Message Template'],
                            [
                                'item' => function($index, $label, $name, $checked, $value) {

                                    $return = '<label class="modal-radio">';
                                    $return .= '<input type="radio" onchange="muFun(this.value)" name="' . $name . '" value="' . $value . '" tabindex="3">';
                                    $return .= '<i></i>';
                                    $return .= '<span>' . ucwords($label) . '</span>';
                                    $return .= '</label>';

                                    return $return;
                                }
                            ]
                        )
                    ->label(false);
                    ?>
                    
	<div id="TLID_DIV" style="display:none">                     
        <?php echo $form->field($model, 'file')->fileInput(['skipOnEmpty' => true, 'accept' => '*/xml', 'onchange'=>'muFun1(this.value)']); ?>
    </div>	
    <?//= $form->field($model, 's_template')->textInput(['maxlength' => true, 'rows' => 6]) ?>
    <?= $form->field($model, 's_template')->textarea(['rows' => 12]) ?>

    <?//= $form->field($model, 'dt_created_date')->textInput() ?>

    <?//= $form->field($model, 'dt_deleted_at')->textInput() ?>


    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
    function muFun(obj){
        if(obj=="1"){
	            document.getElementById('TLID_DIV').style.display="block"; 
	            document.getElementById("phonetexttemplate-s_template").readOnly = true;
	            return false;
            }else{
	            document.getElementById('TLID_DIV').style.display="none"; 
	            document.getElementById("phonetexttemplate-s_template").readOnly = false;
	            document.getElementById("phonetexttemplate-s_template").value = '';
	            return false;
            }
    }; 

    function muFun1(obj){
    	 // alert(obj);
    	 document.getElementById("phonetexttemplate-s_template").value = obj;
    	// document.getElementById("s_template").value = "ddd";
    };      
</script>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\EmailTemplates;
use backend\models\Country;
use backend\models\City;
use backend\models\State;
use backend\models\Zipcode;
use kartik\typeahead\TypeaheadBasic;
?>

                <?php
                    $form = ActiveForm::begin([
                        'id' => 'create-email-criteria',
                        'method' => 'post',
                        'action' => ['campaignemail/createemailcriteria']
                    ]);
                    ?><fieldset style="border:1px solid #c0c0c0 !important; padding: 10px !important">
                        <legend style="width:43% !important; border-width:0px !important">Company Email Criteria</legend>
                        
                    <?
                        echo Html::label('Company City', '', ['class' => '']);
                        echo TypeaheadBasic::widget([
                            'name' => 'company_city',
                            'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => 'Type City name'],
                            'pluginOptions' => ['highlight'=>true],
                        ]);

                        echo Html::label('Company Zip', '', ['class' => '']);                       
                        echo Html::input('text', 'company_zip', '', ['class' => 'form-control']);

                        echo Html::label('Company State', '', ['class' => '']); 
                        echo Html::dropDownList('company_state', null,
                                ArrayHelper::map(State::find()->all(), 'id', 'name'), ['class' => 'form-control']);
                        echo "<br>";
                        echo Html::label('Company Last Bidding Days', '', ['class' => '']); 
                        echo Html::dropDownList('last_bidding_days_operator', null,
                                array('=' => "=",">=" => ">=", "<=" => "<=" ), ['class' => '']);
                        echo Html::input('text', 'last_bidding_days', '', ['class' => '']);
                        echo "<br>";
                        echo Html::label('Company last token purchase days', '', ['class' => '']);  
                        echo Html::dropDownList('last_token_purchase_days_operator', null,
                                array('=' => "=",">=" => ">=", "<=" => "<=" ), ['class' => '']);
                        echo Html::input('text', 'last_token_purchase_days', '', ['class' => '']);
                        echo "<br>"; 
                        echo Html::checkbox('company_closed_account_flag', false, ['label' => 'Company closed Account']);
                        echo "<br>"; 
                        echo Html::checkbox('company_background_check_pending_flag', false, ['label' => 'Company background check is pending']);
                        echo "<br>"; 
                        echo Html::checkbox('company_license_data_missing_flag', false, ['label' => 'Company License data is missing']);
                        echo "<br>"; 
                        // echo Html::checkbox('company_registration_status_pending_flag', false, ['label' => 'Company registration status pending']);  
                        echo "<br>"; 
                        

                        echo Html::label('Company token balance', '', ['class' => '']); 
                        echo Html::dropDownList('company_token_balance_operator', null,
                                array('=' => "=",">=" => ">=", "<=" => "<=" ), ['class' => '']);
                        echo Html::input('text', 'company_token_balance', '', ['class' => '']);
                        echo "<br>"; 
                        
                        ?>
                        </fieldset>
                        <br>
                        <fieldset style="border:1px solid #c0c0c0 !important; padding: 10px !important">
                        <legend style="width:34% !important; border-width:0px !important">User Email Criteria</legend>
                        <?php
                        // User Details
                        echo Html::label('User City', '', ['class' => '']);
                        echo TypeaheadBasic::widget([
                            'name' => 'user_city',
                            'data' => ArrayHelper::map(City::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => 'Type City name'],
                            'pluginOptions' => ['highlight'=>true],
                        ]);

                        echo Html::label('User Zip', '', ['class' => '']);                      
                        echo Html::input('text', 'user_zip', '', ['class' => 'form-control']);

                        echo Html::label('User State', '', ['class' => '']);    
                        echo Html::dropDownList('user_state', null,
                                ArrayHelper::map(State::find()->all(), 'id', 'name'), ['class' => 'form-control']);
                        echo "<br>";

                        echo Html::label('User last login days', '', ['class' => '']);  
                        echo Html::dropDownList('user_last_login_days_operator', null,
                                array('=' => "=",">=" => ">=", "<=" => "<=" ), ['class' => '']);
                        echo Html::input('text', 'user_last_login_days', '', ['class' => '']);
                        echo "<br>"; 

                        echo Html::label('User last job posting days', '', ['class' => '']);    
                        echo Html::dropDownList('user_last_job_posting_days_operator', null,
                                array('=' => "=",">=" => ">=", "<=" => "<=" ), ['class' => '']);
                        echo Html::input('text', 'user_last_job_posting_days', '', ['class' => '']);
                        echo "<br>"; 

                        echo Html::label('User Job posting days and not selecting the winner', '', ['class' => '']);    
                        echo Html::dropDownList('user_not_selecting_winner_operator', null,
                                array('=' => "=",">=" => ">=", "<=" => "<=" ), ['class' => '']);
                        echo Html::input('text', 'user_not_selecting_winner', '', ['class' => '']);
                        echo "<br>"; 

                        // echo Html::checkbox('user_registration_status_pending_flag', false, ['label' => 'user registration status pending']);
                    //  echo "<br>";echo "<br>"; 
                    ?>  
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <?php echo Html::submitButton('Create', ['class' => 'btn btn-primary']);

                    ActiveForm::end(); ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    
                </div>
            
<script type="text/javascript">

    $(function(){

        $('form#create-email-criteria').on('beforeSubmit',function () {
         var form = $(this);
         // return false if form still have some validation errors
         if (form.find('.has-error').length) {
              return false;
         }
         // submit form
             $.ajax({
                  url: form.attr('action'),
                  type: 'post',
                  data: form.serialize(),
                  success: function (response) {
                       if(response){
                            // $(form).trigger("reset");
                            // alert(response);                        
                            $.event.trigger( "addQuery", [ response] );
             
                       }
                       else{
                           console.log("Failed !!!");
                       }
                  }
             });
             return false;
        });
    });       
</script>
  

<style>
    .expand table, .expand .head, .expand .data, .expand .header  {
        border: 1px solid #E1E1E1 ;
        border-collapse: collapse;
        width: 100%;
        text-align: center;
    }
    .expand .head, .expand .data {
        padding: 5px;
        background-color: #ffffff;
    }

    .expand .head{
      font-weight: bold;
    }
    .expand .nav.nav-tabs a {
        background-color: #337ab7;
        color: #fff;
    }
    .expand .table-bordered {
        border: 1px solid #ddd;
    }
    .expand {
        padding: 0 265px;
    }

     .add-menu{
      padding: 10px 282px;
    }
    .expand .nav-tabs > li {
      width: 25%;
    }
    .expand  .active > a {
      background-color: #ffffff !important;
      color: #555 !important;
    }

}
</style>

<?php
use yii\bootstrap\modal;
use yii\helpers\Url;
use kartik\popover\PopoverX;
use backend\models\CompanyLicense;
use backend\models\BackgroundCheck;
use backend\models\CompanyServiceArea;
use yii\helpers\html;
use yii\widgets\ActiveForm;
use backend\models\Zipcode;
use backend\models\CompanyServices;
use backend\models\Subcategory;
use backend\models\City;
use backend\models\State;
//use yii\helpers\ArrayHelper


  

$model1 = new CompanyLicense();
 // print_r($this);
$this->render('../companylicense/_form', array('model'=>$model1))
?>
<div class="row">
  <div class='col-md-12 add-menu'>
    <?php
              echo Html::button('Add Service ', ['value' => Url::to(['companyservices/create', 'company_id' =>$model->id]), 'title' => 'Creating New Service ', 'class' => 'showModalButton btn btn-success add-service-btn', 'id' => 'add-service-btn-'.$model->id, 'company' => $model->id]); 

             
              yii\bootstrap\Modal::begin([
                  'header' => '<h4>Add Service </h4>',
                  'headerOptions' => ['id' => 'modalHeader'],
                  'id' => 'add-service-modal-'.$model->id,
                  'size' => 'modal-md',
                  //keeps from closing modal with esc key or by clicking out of the modal.
                  // user must click cancel or X to close
                  'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
              ]);
              echo "<div id='add-service-modal-content-".$model->id."'></div>";
              yii\bootstrap\Modal::end();

              echo Html::button('Add Service Area', ['value' => Url::to(['companyservicearea/create', 'company_id' =>$model->id]), 'title' => 'Creating New Service Area', 'class' => 'showModalButton btn btn-success add-area-btn', 'id' => 'add-area-btn-'.$model->id, 'company' => $model->id]); 

             
              yii\bootstrap\Modal::begin([
                  'header' => '<h4>Add Service Area12</h4>',
                  'headerOptions' => ['id' => 'modalHeader'],
                  'id' => 'add-area-modal-'.$model->id,
                  'size' => 'modal-md',
                  //keeps from closing modal with esc key or by clicking out of the modal.
                  // user must click cancel or X to close
                  'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
              ]);
              echo "<div id='add-area-modal-content-".$model->id."'></div>";
              yii\bootstrap\Modal::end();

          


              $model2 = new BackgroundCheck();

                echo Html::button('Add Background Check', ['value' => Url::to(['backgroundcheck/create','company_id' =>$model->id]), 'title' => 'Creating New license', 'class' => 'showModalButton btn btn-success add-area-btn', 'id' => 'add-back-check-btn-'.$model->id, 'company' => $model->id]); 

             
              yii\bootstrap\Modal::begin([
                  'header' => '<h4>Add Background Check</h4>',
                  'headerOptions' => ['id' => 'modalHeader'],
                  'id' => 'back-check-modal-'.$model->id,
                  'size' => 'modal-md',
                  //keeps from closing modal with esc key or by clicking out of the modal.
                  // user must click cancel or X to close
                  'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
              ]);
              echo "<div id='back-check-modal-content-".$model->id."'></div>";
              yii\bootstrap\Modal::end();

                $model1 = new CompanyLicense();
             
           echo Html::button('Add Company Licence', ['value' => Url::to(['companylicense/create', 'company_id' =>$model->id]), 'title' => 'Creating New license', 'class' => 'showModalButton btn btn-success add-area-btn', 'id' => 'add-license-btn-'.$model->id, 'company' => $model->id]); 

           
            yii\bootstrap\Modal::begin([
                'header' => '<h4>Add Company Licence</h4>',
                'headerOptions' => ['id' => 'modalHeader'],
                'id' => 'license-modal-'.$model->id,
                'size' => 'modal-md',
                //keeps from closing modal with esc key or by clicking out of the modal.
                // user must click cancel or X to close
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
            ]);
            echo "<div id='license-modal-content-".$model->id."'></div>";
            yii\bootstrap\Modal::end();



            $services = CompanyServices::find()
                  ->where('fk_i_company_id = :fk_i_company_id', [':fk_i_company_id' => $model->id])
                  ->all();

             $areas = CompanyServiceArea::find()
                  ->where('fk_i_company_id = :fk_i_company_id', [':fk_i_company_id' => $model->id])
                  ->all();
            ?>

  </div>
 </div>
 <!-- Liecense and backgrounds tables -->
  <div class="row">
   <div class="col-md-12"> 
   <div class="expand">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#services-<?php echo $model->id ?>" id="services-tab">Services</a></li>
    <li><a data-toggle="tab" href="#area-<?php echo $model->id ?>" id="area-tab">Service Area</a></li>
    <li><a data-toggle="tab" href="#background-<?php echo $model->id ?>" id="background-tab">Background Check</a></li>
    <li><a data-toggle="tab" href="#liecence-<?php echo $model->id ?>" id="liecence-tab">Liecence</a></li>
  </ul>

  <div class="tab-content">
        <div id="services-<?php echo $model->id ?>" class="tab-pane fade in active">
            <table id='t04'  align='center'>
                   <!-- <tr class=''>
                      <th class='header'>Service </th>
                   </tr> -->
                    <?php foreach($services as $service)
                      { ?>

                        <tr class=''>
                          <td class='data'>
                              <?php echo Subcategory::findOne($service['fk_i_service_id'])->name; ?> 
                         </td>
                         </tr>
                    <?php    } ?>
            </table>
        </div> 

        <div id="area-<?php echo $model->id ?>" class="tab-pane fade">
            
              <table id='t03'  align='center' class='table-bordered'>
               <!--   <tr class=''>
                    <th class='header' colspan="2">Service Area</th>
                 </tr> -->
                 <tr class=''>
                    <td class='head'>Zip</td>
                    <td class='head'>City</td>
                 </tr>
                  <?php   foreach($areas as $area)
                    { 
                      ?>
                      <tr class=''>
                      <td class='data'>
                            <?php  echo Zipcode::findOne($area->fk_i_service_area_zip)->zip; ?>
                       </td>
                       <td class='data'>
                            <?php  echo City::findOne(Zipcode::findOne($area->fk_i_service_area_zip)->city_id)->name; ?>
                       </td>

                       </tr>
                   <?php   } ?>
               </table>

        </div>
        <div id="background-<?php echo $model->id ?>" class="tab-pane fade">
             <?php            
              $back_checks = BackgroundCheck::find()
                ->where('fk_i_company_id = :company_id', [':company_id' => $model->id])
                ->all();                  
            ?>    
                <table id="t01" align='center' class='table-bordered'>
                <!--  <tr class=''>
                    <th class='header' colspan="4">Background</th>
                 </tr> -->
                 <tr>                  
                      <td class='head'>Agency</td>
                      <td class='head'>Status</td>
                       <td class='head'>Date</td>
                      <td class='head'>View</td>
                     
                  </tr>
                      <?php  foreach($back_checks as $back_check)
                      { 
                        ?>
                      <tr class=''>                              
                        <td class='data'>
                            <?php  echo $back_check['s_bg_check_agency']; ?>
                        </td>
                        <td class='data'>
                            <?php  echo $back_check['i_bg_check_status']; ?>
                        </td>
                         <td class='data'>
                            <?php  echo date("d-m-Y",strtotime($back_check['dt_bg_check_date'])); ?>
                        </td>
                         <td class='data'>
                            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['backgroundcheck/view', 'id' => $back_check->pk_i_id]) ?>
                        </td>
                        
                       </tr>
                    <?php    
                    }
                    ?>

               </table>

        </div>
         <div id="liecence-<?php echo $model->id ?>" class="tab-pane fade">
                   <?php            
                $company_licenses = CompanyLicense::find()
                ->where('fk_i_company_id = :company_id', [':company_id' => $model->id])
                  ->all();                  
            ?>    


              <table id='t02'  align='center' class='table-bordered'>
              <!--  <tr class=''>
                    <th class='header' colspan="5">License</th>
               </tr> -->
               <tr>
                <td class='head'>State</td>
                  <td class='head'>Accreditation</td>
                  <td class='head'>Accreditation#</td>
                  <td class='head'>Expiration</td>
                  <td class='head'>View</td>
                </tr>
                <?php  foreach($company_licenses as $company_license)
                { 
                ?>

                <tr class=''>
                <td class='data'>
                    <?php  echo State::findOne($company_license['fk_i_state_id'])->name; ?>
                 </td>
                  <td class='data'>
                    <?php  echo $company_license['s_accreditation']; ?>
                 </td>
                  <td class='data'>
                    <?php  echo $company_license['s_accreditation_hash']; ?>
                 </td>
                  <td class='data'>
                    <?php  echo $company_license['dt_expiration']; ?>
                 </td>
                 <td class='data'>
                            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['companylicense/view', 'id' => $company_license->pk_i_id]) ?>
                        </td>
                 </tr>
              <?php   } ?>
             </table>
        </div>
    </div>
    </div>
  </div>   
</div>



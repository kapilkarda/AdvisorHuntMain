<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\models\Company;
use backend\models\State;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyLicenseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Licenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary company-license-index">
    <div class="box-header with-border">
    <h3 class="box-header"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body company-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php  echo Html::button('New Company Licenses', ['value' => Url::to(['companylicense/create']), 'title' => 'Creating New license', 'class' => 'showModalButton btn btn-success', 'id' => 'add-license-btn']); 

           
            yii\bootstrap\Modal::begin([
                'header' => 'Create Company Licenses',
                'headerOptions' => ['id' => 'modalHeader'],
                'id' => 'license-modal',
                'size' => 'modal-md',
                //keeps from closing modal with esc key or by clicking out of the modal.
                // user must click cancel or X to close
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
            ]);
            echo "<div id='license-modal-content'></div>";
            yii\bootstrap\Modal::end();
        ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'pk_i_id',
        //    'fk_i_state_id',
              [
                    'label' => 'State',
                    'value' => function ($data){ return State::findOne($data->fk_i_state_id)->name;} 
                ],
             [
                    'label' => 'Company',
                    'value' => function ($data){ return Company::findOne($data->fk_i_company_id)->name;} 
                ],
            's_accreditation',
            's_accreditation_hash',
            's_license_details',
            'dt_expiration',
      //      'fk_i_company_id',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</section>
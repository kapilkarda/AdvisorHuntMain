<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\State;
use backend\models\City;
use backend\models\Country;
use backend\models\Zipcode;
use backend\models\Subcategory;
use webvimark\modules\UserManagement\models\User;


/* @var $this yii\web\View */
/* @var $model backend\models\Lead */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
  <section class="content">
  <div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-7">
	<div class="box">
			<div class="box-header">
			    <h1><?= Html::encode($model->s_name) ?></h1>
			</div>
			<div class="box-body">
			
			    <p>
			        <?= Html::a('Update', ['update', 'id' => $model->pk_i_id], ['class' => 'btn btn-primary']) ?>
			        <?= Html::a('Delete', ['delete', 'id' => $model->pk_i_id], [
			            'class' => 'btn btn-danger',
			            'data' => [
			                'confirm' => 'Are you sure you want to delete this item?',
			                'method' => 'post',
			            ],
			        ]) ?>
			    </p>
			
			    <?= DetailView::widget([
			        'model' => $model,
			        'attributes' => [
			            'pk_i_id',
			            's_name',
			             [
			                'label' => 'Service',
			                'value' => Subcategory::findOne($model->fk_i_sub_category_id)->name,
			            ],
			            // 'fk_i_sub_category_id',
			            's_address',
			            's_address1',
			            // 'fk_i_city_id',
			            // 'fk_i_state_id',
			            // 'fk_i_country_id',
			            // 'fk_i_zip_id',
			
			               [
			                'label' => 'City',
			                'value' => City::findOne($model->fk_i_city_id)->name,
			            ],
			            // 'state_id',
			             [
			                'label' => 'State',
			                'value' => State::findOne($model->fk_i_state_id)->name,
			            ],
			            // 'country_id',
			             [
			                'label' => 'Country',
			                'value' =>  Country::findOne($model->fk_i_country_id)->name,
			            ],
			            // 'zip_id',
			            [
			                'label' => 'Zipcode',
			                'value' => Zipcode::findOne($model->fk_i_zip_id)->zip,
			            ],
			
			           
			
			            's_email:email',
			            's_mobile',
			            's_ip_address',
			            'i_status',
			          //  'fk_i_requested_by',
			
			            [
			                'label' => 'Requested By',
			                'value' => User::findOne($model->fk_i_requested_by)->email,
			            ],
			            'dt_date_created',
			            'dt_request_complete_date',
			            'i_request_renewed_count',
			            'dt_request_renew_date',
			        ],
			    ]) ?>
			
			</div>
	</div>
</div>
</div>
</section>
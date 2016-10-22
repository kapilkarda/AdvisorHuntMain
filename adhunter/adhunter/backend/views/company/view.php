<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use webvimark\modules\UserManagement\models\User;
use backend\models\State;
use backend\models\City;
use backend\models\Country;
use backend\models\Zipcode;


/* @var $this yii\web\View */
/* @var $model backend\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-7">
	<div class="box box-primary">
	  	<div class="box-header with-border">
	  		<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
	    </div>
	    <div class="box-body">
	    <p>
	        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
	            'id',
	            'name',
	            'address',
	            'address1',
	            // 'city_id',
	            [
	                'label' => 'City',
	                'value' => City::findOne($model->city_id)->name,
	            ],
	            // 'state_id',
	             [
	                'label' => 'State',
	                'value' => State::findOne($model->state_id)->name,
	            ],
	            // 'country_id',
	             [
	                'label' => 'Country',
	                'value' =>  Country::findOne($model->country_id)->name,
	            ],
	            // 'zip_id',
	            [
	                'label' => 'Zipcode',
	                'value' => Zipcode::findOne($model->zip_id)->zip,
	            ],
	
	            [
	                'label' => 'Services',
	                'value' => $model->getCategorysOfCompany($model->id),
	            ],
	            'about:ntext',
	            'year_founded',
	            'website',
	            [     
	                'label' => 'Profile Pic',
	                'value' => Yii::$app->get('s3bucket')->getUrl('profile/thumbs/'.$model->profile_pic),
	                 'format' => ['image',['width'=>'100','height'=>'100']],
	            ],
	            [     
	                'label' => 'Banner',
	                'value' => Yii::$app->get('s3bucket')->getUrl('banner/thumbs/'.$model->banner),
	                 'format' => ['image',['width'=>'400','height'=>'100']],
	            ],
	            // 'banner',
	            'phone',
	            'mobile',
	            'mobile_alert_flag',
	            'email:email',
	            //'notification_to_email:email',
	            'closed_company_flag',
	            // 'user_id',
	             [
	                'label' => 'User',
	                'value' => User::findOne($model->user_id)->email,
	            ],
	            'active_company_flag',
	            'company_claimed',
	            // 'invoice_logo',
	             [     
	                'label' => 'Invoice Logo',
	                'value' => Yii::$app->get('s3bucket')->getUrl('invoice_logo/thumbs/'.$model->invoice_logo),
	                 'format' => ['image',['width'=>'100','height'=>'100']],
	            ],
	        ],
	    ]) ?>
	
		</div>
	</div>
</div>
</div>
</section>

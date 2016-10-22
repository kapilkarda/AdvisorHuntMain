<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use webvimark\modules\UserManagement\models\User;
use backend\models\State;
use backend\models\City;
use backend\models\Country;
use backend\models\Zipcode;
/* @var $this yii\web\View */
/* @var $model backend\models\UserDetails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="user-details-view">-->
<section class="content">
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-7">
<div class="box box-primary user-details-view">
    <div class="box-header with-border">
    <h5 class="box-title><?= Html::encode($this->title) ?></h5>
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
            'first_name',
            'last_name',
            // 'profile_pic',
             [     
                'label' => 'Profile Pic',
                'value' => Yii::$app->get('s3bucket')->getUrl('profile/thumbs/'.$model->profile_pic),
                 'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'email:email',
            'phone',
            'mobile',
            'address',
            'address1',
            //'city_id',
            //'state_id',
            //'zip_id',
            //'country_id',
             [
                'label' => 'City',
                'value' => City::findOne($model->id)->name,
            ],
            // 'state_id',
             [
                'label' => 'State',
                'value' => State::findOne($model->state_id)->name,
            ],
              // 'zip_id',
              [
                'label' => 'Zip Id',
                'value' => Zipcode::findOne($model->zip_id)->zip,
            ],
            // 'country_id',
             [
                'label' => 'Country',
                'value' =>  Country::findOne($model->country_id)->name,
            ],
           //'user_id',
            [
                'label' => 'User',
                'value' => User::findOne($model->user_id)->email,
            ],
            'dynamic1',
            'dynamic2',
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>

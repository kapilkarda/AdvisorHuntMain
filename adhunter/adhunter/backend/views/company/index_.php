<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\State;
use backend\models\City;
use backend\models\Country;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-header with-border">
    <h3 class="box-header"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body company-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name',
            'address',
            'address1',
            // 'city_id',
             [
                'label' => 'City',
                'value' => function ($data){ return City::findOne($data->city_id)->name;} 
            ],
            // 'state_id',
            // 'country_id',
            // 'zip_id',
            // 'about:ntext',
            // 'year_founded',
            // 'website',
            // 'profile_pic',
            // 'banner',
            // 'phone',
            'mobile',
            // 'mobile_alert_flag',
            // 'email:email',
            // 'notification_to_email:email',
            // 'user_id',
             [
                'label' => 'User',
                'value' => function ($data){ return User::findOne($data->user_id)->email;} 
            ],
            // 'active_company_flag',
            // 'company_claimed',
            // 'invoice_logo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</section>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use webvimark\modules\UserManagement\models\User;
use backend\models\Company;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyReviewByExternalCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Review By External Companies';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="box box-primary">
    <div class="box-header with-border">
    <h3 class="box-header"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body company-rating-index"> 
    <p>
        <?= Html::a('Create Company Review By External Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'pk_i_id',
           // 'fk_i_company_id',
            [
                'label' => 'Company',
                'value' => function ($data){ return Company::findOne($data->fk_i_company_id)->name;} 
            ],
            's_yelp_rating_url:url',
            's_google_rating',
            's_BBB_ratings',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
</div>
</section>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use webvimark\modules\UserManagement\models\User;
use backend\models\Zipcode;
use backend\models\Company;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-7">
<div class="box box-primary project-view">
    <div class="box-header with-border">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
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
            // 'fk_i_requested_by',
            [
                'label' => 'User',
                'value' => User::findOne($model->fk_i_requested_by)->email,
            ],
            's_name',
            'i_type',
            'f_cost',
            's_duration',
            's_description:ntext',
            's_address',
            // 'fk_i_zip_id',
             [
                'label' => 'Zipcode',
                'value' => Zipcode::findOne($model->fk_i_zip_id)->zip,
            ],
            // 'fk_i_company_id',
              [
                'label' => 'Company',
                'value' => Company::findOne($model->fk_i_company_id)->name,
            ],
            'dt_created_at',
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>
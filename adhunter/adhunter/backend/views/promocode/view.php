<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PromoCode */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Promo Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--//<div class="promo-code-view">-->
<section class="content">
    <div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-7">
<div class="box box-primary promo-code-view">
    <div class="box-header with-border">
    <h5 class="box-title"><?= Html::encode($this->title) ?></h5>
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
            'i_code',
            'i_no_of_tokens',
            'dt_start_date',
            'dt_end_date',
            //'dt_created_at',
            //'dt_deleted_at',
        ],
    ]) ?>

</div>
</div>
</div>
</div>

</section>

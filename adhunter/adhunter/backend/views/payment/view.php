<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\payment */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<section class="content">
<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
<div class="box">
        
   <div class="box-header">
     <h1><?= Html::encode($this->title) ?></h1>
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
            'fk_i_purchase_order_id',
            'fk_i_invoice_id',
            's_payment_type',
            'fk_i_user_id',
            'f_amount',
            'b_payments_successful',
            's_payment_ip',
            'dt_created_at',
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>


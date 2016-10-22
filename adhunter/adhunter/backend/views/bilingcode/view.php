<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BilingCode */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Biling Codes', 'url' => ['index']];
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
            'i_biling_Code',
            's_billing_code_details',
            'dt_billing_code_start_date',
            'dt_billing_code_end_date',
            'i_token_count_slab1_id',
            'i_token_count_slab2_id',
            'i_token_count_slab3_id',
	    'i_default_billing',
            's_discounts',
	    
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>

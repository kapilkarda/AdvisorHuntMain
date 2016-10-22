<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Proimage */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Proimages', 'url' => ['index']];
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
            'fk_i_pro_user_id',
            'fk_i_project_id',
//             's_image_type',
        		['label' => 'Image Type',
        		'value' =>( ($model->s_image_type ==0) ? "Past Project": (($model->s_image_type ==1)? "Profile" : "Invoice")),
        		],
            's_image',
            's_image_alt_details',
            'd_upload_date',
            'b_status',
           // 'dt_deleted_at', 
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>


<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PhoneTextTemplate */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Phone Text Templates', 'url' => ['index']];
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
           // 'i_template_type',
        	['label' => 'Template Type',
        		'value' =>( ($model->i_template_type ==0) ? "Text Message Template": (($model->i_template_type ==1)? "Voice Call Template" : "Null")),
        	],
            's_template',

            'dt_created_date',
            //'dt_deleted_at',
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>

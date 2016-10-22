<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Subcategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Header (Page header) -->
<section class="content">
<div class="row">
<div class="col-md-1">
</div>
<div class="col-md-9">
    <div class="box">
    <div class="box-header">
      <h3><?= Html::encode($this->title) ?></h3>
    </div>

     <!-- Main content -->
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
            'description',
        	's_image',
            'category_id',

        	'b_front_page',


        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>
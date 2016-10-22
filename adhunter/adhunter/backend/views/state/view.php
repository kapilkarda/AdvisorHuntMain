<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Country;


/* @var $this yii\web\View */
/* @var $model backend\models\State */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'States', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row" >
<div class="col-md-3">
</div>
<div class="col-md-6">
<div class="box box-primary">
    <div class="box-header with-border">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
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
            'name:ntext',
            // 'country_id',
             [
                'label' => 'Country',
                'value' => Country::findOne($model->country_id)->name
            ],

        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>
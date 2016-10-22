<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TokenCounts */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Token Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="token-counts-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            's_token_count_slab',
            'i_token_count',
            'f_price',
            's_validity_days',
        ],
    ]) ?>

</div>

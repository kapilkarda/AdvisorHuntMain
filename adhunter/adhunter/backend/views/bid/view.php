<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Bid */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Bids', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <section class="content">
<div class="box">
<div class="box-header">
  <h1><?= Html::encode($model->pk_i_id) ?></h1>
</div>
<div class="box-body bid-view">
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
            'fk_i_lead_id',
            'fk_i_user_id',
            's_ip_address',
            'fk_i_token_used_id',
            'i_status',
        ],
    ]) ?>

</div>
</div>
</section>
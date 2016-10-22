<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\referral */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Referrals', 'url' => ['index']];
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
            's_referral_details',
            'i_referral_status',
            'fk_i_requested_user_id',
            's_referral_sent_to_name',
            's_referral_sent_to_email:email',
            's_referral_sent_to_mobile',
            's_referral_sent_to_message',
            'dt_referral_sent_date',
            'i_referral_rminder_count',
            'dt_last_reminder_date',
            'fk_i_referral_billing_code',
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>

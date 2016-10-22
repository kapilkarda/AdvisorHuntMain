<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Bid */

$this->title = 'Update Bid: ' . $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Bids', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_i_id, 'url' => ['view', 'id' => $model->pk_i_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content">
<div class="box box-primary bid-update">
    <div class="box-header with-border">
    	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
      <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</section>

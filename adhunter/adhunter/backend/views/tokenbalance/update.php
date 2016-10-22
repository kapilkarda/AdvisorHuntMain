<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TokenBalance */

$this->title = 'Update Token Balance: ' . $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Token Balances', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_i_id, 'url' => ['view', 'id' => $model->pk_i_id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<section class="content">
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-7">
		<div class="box box-primary promo-code-update">
		    <div class="box-header with-border">
    <h5 class="box-title"><?= Html::encode($this->title) ?></h5>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
</div>
</section>

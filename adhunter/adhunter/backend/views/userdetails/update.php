<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\UserDetails */

$this->title = 'Update User Details: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<!--<div class="user-details-update">-->
<section class="content">
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-7">
		<div class="box box-primary user-details-update">
		    <div class="box-header with-border">
		    <h5 class="box-title><?= Html::encode($this->title) ?></h5>
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
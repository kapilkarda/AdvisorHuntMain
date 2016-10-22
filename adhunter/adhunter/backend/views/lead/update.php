<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Lead */

$this->title = 'Update Lead: ' . $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Leads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_i_id, 'url' => ['view', 'id' => $model->pk_i_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content">
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-7">
		<div class="box box-primary lead-create">
		    <div class="box-header with-border">
		    	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
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

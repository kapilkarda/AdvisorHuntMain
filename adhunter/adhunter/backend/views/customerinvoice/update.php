<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\customerinvoice */

$this->title = 'Update Customerinvoice: ' . $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Customerinvoices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_i_id, 'url' => ['view', 'id' => $model->pk_i_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content">
	<div class="row">
		<div class="col-md-3">
		</div>
		<div class="col-md-6">
			<div class="box box-primary biling-code-update">
				<div class="box-header with-border">
				   <!--<div class="biling-code-update">-->
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
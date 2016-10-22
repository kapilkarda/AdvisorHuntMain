<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\payment */

$this->title = 'Create Payment';
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="row">
	<div class="col-md-3">
	</div>
	<div class="col-md-6">
		<div class="box box-primary biling-code-create">
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

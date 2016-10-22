<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\referral */

$this->title = 'Create Referral';
$this->params['breadcrumbs'][] = ['label' => 'Referrals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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

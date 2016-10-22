<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = 'Create Project';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-7">
			<div class="box box-primary project-create">
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

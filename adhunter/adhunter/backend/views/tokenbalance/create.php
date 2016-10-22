<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TokenBalance */

$this->title = 'Create Token Balance';
$this->params['breadcrumbs'][] = ['label' => 'Token Balances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-7">
			<div class="box box-primary promo-code-create">
			    <div class="box-header with-border">
    <h3><?= Html::encode($this->title) ?></h3>
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
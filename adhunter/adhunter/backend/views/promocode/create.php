<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PromoCode */

$this->title = 'Create Promo Code';
$this->params['breadcrumbs'][] = ['label' => 'Promo Codes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="promo-code-create">-->
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
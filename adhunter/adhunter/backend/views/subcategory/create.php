<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subcategory */

$this->title = 'Create Subcategory';
$this->params['breadcrumbs'][] = ['label' => 'Subcategories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-7">
<div class="box box-primary">
	<div class="box-header with-border">
	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
	</div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
</section>
<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Zipcode */

$this->title = 'Create Zipcode';
$this->params['breadcrumbs'][] = ['label' => 'Zipcodes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row">
<div class="col-md-4">
</div>
<div class="col-md-4">
<div class="box box-primary">
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

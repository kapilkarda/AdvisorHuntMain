<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PhoneTextTemplate */

$this->title = 'Update Phone Text Template: ' . $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Phone Text Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_i_id, 'url' => ['view', 'id' => $model->pk_i_id]];
$this->params['breadcrumbs'][] = 'Update';
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
    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
</div>
</section>


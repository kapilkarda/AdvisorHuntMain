<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TokenCounts */

$this->title = 'Update Token Counts: ' . $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Token Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_i_id, 'url' => ['view', 'id' => $model->pk_i_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section class="content">
<div class="box box-primary token-counts-update">
    <div class="box-header with-border">
    	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div></section>


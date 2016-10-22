<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TokenCounts */

$this->title = 'Create Token Counts';
$this->params['breadcrumbs'][] = ['label' => 'Token Counts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary token-counts-create">
    <div class="box-header with-border">
    	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div></section>

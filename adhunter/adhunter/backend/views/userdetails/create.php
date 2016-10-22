<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserDetails */

$this->title = 'Create User Details';
$this->params['breadcrumbs'][] = ['label' => 'User Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-7">
    <div class="box box-primary user-details-create">
    <div class="box-header with-border">
     <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
   </div>
    <div class="box-body">
   <h1><?//= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
</div>
</section>

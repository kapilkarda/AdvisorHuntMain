<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Settings */

$this->title = 'Create Settings';
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-7">
<div class="box box-primary">
    <div class="box-header with-border settings-create">
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
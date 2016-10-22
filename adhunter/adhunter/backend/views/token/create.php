<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Token */

$this->title = 'Create Token';
$this->params['breadcrumbs'][] = ['label' => 'Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary token-create">
    <div class="box-header with-border">
    	<h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
  
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</section>
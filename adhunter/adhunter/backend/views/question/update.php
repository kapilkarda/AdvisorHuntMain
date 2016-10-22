<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = 'Update Question: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<section class="content">
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-7">
		<div class="box box-primary promo-code-update">
		    <div class="box-header with-border">
    <h5 class="box-title"><?= Html::encode($this->title) ?></h5>
    </div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model, 'answermodel' => $answermodel,
    ]) ?>

</div>
</div>
</div>
</div>
</section>


<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\QuestionType */

$this->title = 'Update Question Type: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Question Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
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
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
</div>
</section>


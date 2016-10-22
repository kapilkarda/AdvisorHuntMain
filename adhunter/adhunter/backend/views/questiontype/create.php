<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\QuestionType */

$this->title = 'Create Question Type';
$this->params['breadcrumbs'][] = ['label' => 'Question Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
	<div class="row">
		<div class="col-md-2">
		</div>
		<div class="col-md-7">
			<div class="box box-primary promo-code-create">
			    <div class="box-header with-border">
    <h3><?= Html::encode($this->title) ?></h3>
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

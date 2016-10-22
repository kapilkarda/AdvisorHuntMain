<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BackgroundCheck */

$this->title = 'Create Background Check';
$this->params['breadcrumbs'][] = ['label' => 'Background Checks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class=" background-check-create">
   
    <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</section>


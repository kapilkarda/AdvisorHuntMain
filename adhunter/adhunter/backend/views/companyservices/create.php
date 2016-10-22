<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CompanyServices */

$this->title = 'Create Company Services';
$this->params['breadcrumbs'][] = ['label' => 'Company Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-services-create">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyReviewByExternalCompany */

$this->title = 'Update Company Review By External Company: ' . $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Company Review By External Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pk_i_id, 'url' => ['view', 'id' => $model->pk_i_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-review-by-external-company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

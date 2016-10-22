<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Company;
use backend\models\State;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyLicense */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Company Licenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="col-md-2">
</div>
<div class="col-md-7">
<div class="box box-primary company-license-view">
    <div class="box-header with-border">
    <h3 class="box-header"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body company-index">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pk_i_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pk_i_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pk_i_id',
            //'fk_i_state_id',
               [
                    'label' => 'Company',
                    'value' => Company::findOne($model->fk_i_company_id)->name,
                ],
            [
                    'label' => 'State',
                    'value' => State::findOne($model->fk_i_state_id)->name,
                ],
          
            's_accreditation',
            's_accreditation_hash',
            's_license_details',
            'dt_expiration',
          //  'fk_i_company_id',
        ],
    ]) ?>

</div>
</div>
</div>
</div></section>
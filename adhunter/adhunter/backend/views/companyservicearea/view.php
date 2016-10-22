<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Company;
use backend\models\Zipcode;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyServiceArea */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Company Service Areas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="col-md-2">
</div>
<div class="col-md-7">
<div class="box box-primary company-service-area-view">
    <div class="box-header with-border">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
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
            //'fk_i_company_id',
          //  'fk_i_service_area_zip',
            [
                'label' => 'Company',
                'value' => Company::findOne($model->fk_i_company_id)->name
            ],

             [
                'label' => 'Zipcode',
                'value' => Zipcode::findOne($model->fk_i_service_area_zip)->zip 
            ],
        ],
    ]) ?>

</div>
</div>
</div>
</div></section>
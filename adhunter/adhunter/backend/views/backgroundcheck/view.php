<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Company;
/* @var $this yii\web\View */
/* @var $model backend\models\BackgroundCheck */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Background Checks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="row">
<div class="col-md-2">
</div>
<div class="col-md-7">
<div class="box box-primary background-check-create">
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
           // 'fk_i_company_id',
             [
                    'label' => 'Company',
                    'value' => Company::findOne($model->fk_i_company_id)->name,
                ],
            'dt_bg_check_date',
            's_bg_check_agency',
            // 's_bg_check_report_image',
            [     
                'label' => 'Bg Check Report Image',
                'value' => Yii::$app->get('s3bucket')->getUrl('back_check_image/thumbs/'.$model->s_bg_check_report_image),
                 'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'i_bg_check_status',
            's_bg_check_comments',
            's_bg_check_validity',
        ],
    ]) ?>

</div>
</div>
</div>
</div>
</section>
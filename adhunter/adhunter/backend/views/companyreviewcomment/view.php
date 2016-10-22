<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Company;
use backend\models\Project;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyReviewComment */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Company Review Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="box box-primary company-review-comment-view">
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
          //  's_review_by',
            [
                'label' => 'Project',
                'value' => Project::findOne($model->fk_i_project_id)->s_name
            ],
            [
                'label' => 'Company',
                'value' => Company::findOne($model->fk_i_company_id)->name
            ],
            [
                'label' => 'Review By',
                'value' => User::findOne($model->s_review_by)->email
            ],
            's_review_comment',
            'i_status',
            'dt_review_date',
        ],
    ]) ?>

</div>
</div>
</section>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Zipcode;
use backend\models\State;
use backend\models\City;
/* @var $this yii\web\View */
/* @var $model backend\models\Token */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Tokens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box">

<div class="box-header">
    <h1><?= Html::encode($this->title) ?></h1>
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
            'fk_i_sub_category_id',
            
             [
                'label' => 'State',
                'value' => State::findOne($model->state_id)->name,
            ],
            [
                'label' => 'City',
                'value' => City::findOne($model->city_id)->name,
            ],
            
            [
                'label' => 'Zipcode',
                'value' => Zipcode::findOne($model->fk_i_zip_id)->zip,
            ],
            'i_project_cost_range_from',
            'i_project_cost_range_to',
            'i_token_count',
        ],
    ]) ?>
</div>
</div>
</section>
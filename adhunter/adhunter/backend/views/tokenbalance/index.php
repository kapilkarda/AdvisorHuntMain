<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\editable\Editable;
use kartik\grid\GridView;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;
use backend\models\Company;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TokenBalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Token Balances';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
<!--<div class="token-balance-index">-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   <div class="box-body">
    <p>
        <?//= Html::a('Create Token Balance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
        <?php  $gridColumns = [
    [
        'class'=>'kartik\grid\SerialColumn',
        'contentOptions'=>['class'=>'kartik-sheet-style'],
        'width'=>'36px',
        'header'=>'',
        'headerOptions'=>['class'=>'kartik-sheet-style']
    ],
    // [
    //     'class'=>'kartik\grid\ExpandRowColumn',
    //     'width'=>'45px',
    //     'value'=>function ($model, $key, $index, $column) {
    //         return GridView::ROW_COLLAPSED;
    //     },
    //     'detail'=>function ($model, $key, $index, $column) {
    //         return Yii::$app->controller->renderPartial('_expand-row-details', ['model'=>$model]);
    //     },
    //     'headerOptions'=>['class'=>'kartik-sheet-style'], 
    //     'expandOneOnly'=>true
    // ],
   
    [
        'attribute'=>'fk_i_user_id', 
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>function ($model, $key, $index, $widget) { 
            return Company::findOne($model->fk_i_user_id)->name;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->orderBy('name')->asArray()->all(), 'id', 'name'),            
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Company'],
        'format'=>'raw'
    ],
    
    [
        'attribute'=>'i_prev_balance', 
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'19%',
    ],
    [
        'attribute'=>'i_current_balance', 
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'19%',
    ],
        [
        'attribute'=>'dt_last_purchase_date', 
        'filterType'=>GridView::FILTER_DATE,
        'filterWidgetOptions' => [
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'opens' => 'left',
                ],
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'19%',
        'format'=>'date',
    ],
    [

        'class'=>'kartik\grid\ActionColumn',
    ],
 
];

?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
          'columns'=>$gridColumns,
            'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
            'headerRowOptions'=>['class'=>'kartik-sheet-style'],
            'filterRowOptions'=>['class'=>'kartik-sheet-style'],
            'pjax'=>true, // pjax is set to always true for this demo
            // set your toolbar
            'toolbar'=> [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',  ['create'],['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>'Reset Grid']) . ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
                ],
                '{export}',
                '{toggleData}',
            ],
            // set export properties
            'export'=>[
                'fontAwesome'=>true
            ],
            // parameters from the demo form
            'bordered'=>true,
            'striped'=>true,
            'condensed'=>false,
            'responsive'=>true,
            'hover'=>true,
            'showPageSummary'=>false,
            'panel'=>[
				'type'=>GridView::TYPE_PRIMARY,
    			'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '. $this->title . '</h3>',
    			'footer'=>false
            ],
            'persistResize'=>false,
            'exportConfig'=>true,
        //'columns' => [
        //    ['class' => 'yii\grid\SerialColumn'],
        //
        //    'pk_i_id',
        //    'fk_i_user_id',
        //    'i_prev_balance',
        //    'i_current_balance',
        //    'dt_last_purchase_date',
        //    // 'dt_last_used_date',
        //
        //    ['class' => 'yii\grid\ActionColumn'],
        //],
    ]); ?>
</div>
</div>
</section>
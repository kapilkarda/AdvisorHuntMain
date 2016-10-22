<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\TokenCountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Token Counts';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-body token-counts-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a('Create Token Counts', ['create'], ['class' => 'btn btn-success']) ?>
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
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_token_count_slab', 
        'editableOptions'=>[
            'header'=>'Token Count Slab', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'19%',
    ],
    
     [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'i_token_count', 
        'editableOptions'=>[
            'header'=>'No of Tokens', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'19%',
    ],
      [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'f_price', 
        'editableOptions'=>[
            'header'=>'Price', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'19%',
    ],
        [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_validity_days', 
        'editableOptions'=>[
            'header'=>'Validity Days', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'19%',
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
        //    // 'pk_i_id',
        //    's_token_count_slab',
        //    'i_token_count',
        //    'f_price',
        //    's_validity_days',
        //
        //    ['class' => 'yii\grid\ActionColumn'],
        //],
    ]); ?>
</div>
</div>
</section>
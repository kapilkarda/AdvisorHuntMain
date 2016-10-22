<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\City;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ZipcodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Zipcode';
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
        'width'=>'5%',
        'header'=>'',
        'headerOptions'=>['class'=>'kartik-sheet-style']
    ],
    [
       	'attribute'=>'city_id',
    	'label' =>'City',
    	'value' => function ($data){ return City::findOne($data->city_id)->name;},
       	'hAlign'=>'center',
       	'vAlign'=>'middle',
       	'width'=>'25%',
    ],
    [
        'attribute'=>'zip', 
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'20%',
    ],   
    [
        'attribute'=>'latitude', 
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'20%',
    ],
      [
        'attribute'=>'longitude', 
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'20%',
    ],
    [

        'class'=>'kartik\grid\ActionColumn',
    ],
 
];

?>
    
    <?php echo GridView::widget([
    'id' => 'company-list',
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
 	'resizableColumns'=>true,
 	//'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
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
//     'allowPageSetting'=>true,
    'hover'=>true,
    'showPageSummary'=>false,
    'panel'=>[
        'type'=>GridView::TYPE_PRIMARY,
    	'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '. $this->title . '</h3>',
    	// 'footer'=>true
    ],
    'persistResize'=>false,
    'exportConfig'=>true,
    
]);
?>  
</div>
</div>
</section>

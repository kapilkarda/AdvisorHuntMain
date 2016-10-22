<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\widgets\Typeahead;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PromoCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Promo Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="promo-code-index">-->
<section class="content">
<div class="box box-primary">   
   <div class="box-body"> 
    <h1><?//= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?//= Html::a('Create Promo Code', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php
    $gridColumns = [
        [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'36px',
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
        ],
     
          [
           // 'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'i_code',
             'label' =>'Code',
            'vAlign'=>'middle',
            'width'=>'11%',
//             'editableOptions'=> function ($model, $key, $index){
//                 return [
//                     'header'=>'Code', 
//                     'size'=>'sm',
//                 ];
//             }
        ],
      [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'i_no_of_tokens',
            'label' =>'No Of Token',
            'editableOptions'=>[
                'header'=>'No Of Token', 
                'size'=>'sm',
            ],
            'hAlign'=>'left',
            'vAlign'=>'middle',
            'width'=>'15%',
        ],
         [
            // 'class'=>'kartik\grid\EditableColumn',
            'filterType'=>GridView::FILTER_DATE,
            'filterWidgetOptions' => [
              'pluginOptions' => [
                  'format' => 'yyyy-mm-dd',
              ],
            ],
            'attribute'=>'dt_start_date',
         	'format'=>'date',
             'label' =>'Start Date',
            // 'editableOptions'=>[
            //     'header'=>'Start Date', 
            //     'size'=>'sm',
            // ],
            'hAlign'=>'left',
            'vAlign'=>'middle',
            'width'=>'15%',
        ],
            [
            // 'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'dt_end_date',
            'filterType'=>GridView::FILTER_DATE,
            'filterWidgetOptions' => [
              'pluginOptions' => [
                  'format' => 'yyyy-mm-dd',
              ],
            ],
            'format'=>'date',
             'label' =>'End Date',
            // 'editableOptions'=>[
            //     'header'=>'End Date', 
            //     'size'=>'sm',
            // ],
            'hAlign'=>'left',
            'vAlign'=>'middle',
            'width'=>'15%',
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
    ]);
    ?>
    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pk_i_id',
            'i_code',
            'i_no_of_tokens',
            'dt_start_date',
            'dt_end_date',
            // 'dt_created_at',
            // 'dt_deleted_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>
</div>
</div>

</section>

<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\TokenCounts;
use backend\models\BilingCode;
use yii\helpers\ArrayHelper;



/* @var $this yii\web\View */
/* @var $searchModel backend\models\BilingCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Biling Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">

 <div class="box-body biling-code-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
  <?php  $gridColumns = [
//     [
//         'class'=>'kartik\grid\SerialColumn',
//         'contentOptions'=>['class'=>'kartik-sheet-style'],
//         'width'=>'40px',
//         'header'=>'',
//         'headerOptions'=>['class'=>'kartik-sheet-style']
//     ],
    
    [
              'attribute'=>'i_biling_Code', 
              'vAlign'=>'middle',
              'width'=>'180px',
              'value'=>function ($model, $key, $index, $widget) { 
                  return BilingCode::findOne($model->pk_i_id)->i_biling_Code;
              },
              'filterType'=>GridView::FILTER_SELECT2,
              'filter'=>ArrayHelper::map(BilingCode::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id', 'i_biling_Code'), 
              'filterWidgetOptions'=>[
                  'pluginOptions'=>['allowClear'=>true],
              ],
              'filterInputOptions'=>['placeholder'=>'Billing Code'],
              'format'=>'raw'
      ],
    [
       // 'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_billing_code_details', 
//         'editableOptions'=>[
//             'header'=>'Biling Code Details', 
//             'size'=>'sm',
//         ],
        //'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'20%',
    ],
    [
        'filterType'=>GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
            ],
        ],
        'attribute'=>'dt_billing_code_start_date', 
    	'format'=>'date',
        'value'=>function ($model, $key, $index, $widget) { 
            return Yii::$app->Helpers->date($model->dt_billing_code_start_date);
        },
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'15%',
    ],
    [
        'filterType'=>GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
            ],
        ],
        'attribute'=>'dt_billing_code_end_date', 
      	'format'=>'date',

        'value'=>function ($model, $key, $index, $widget) { 
            return Yii::$app->Helpers->date($model->dt_billing_code_end_date);
        },
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'15%',
    ],
    [
        'attribute'=>'i_token_count_slab1_id', 
        'vAlign'=>'middle',
        'width'=>'7%',
        'value'=>function ($model, $key, $index, $widget) { 
            return TokenCounts::findOne($model->i_token_count_slab1_id)->s_token_count_slab;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(TokenCounts::find()->where('dt_deleted_at IS NULL')->orderBy('s_token_count_slab')->asArray()->all(), 'pk_i_id', 's_token_count_slab'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Select Slab1'],
        'format'=>'raw'
    ],
   
     [
        'attribute'=>'i_token_count_slab2_id', 
        'vAlign'=>'middle',
        'width'=>'7%',
        'value'=>function ($model, $key, $index, $widget) { 
            return TokenCounts::findOne($model->i_token_count_slab2_id)->s_token_count_slab;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(TokenCounts::find()->where('dt_deleted_at IS NULL')->orderBy('s_token_count_slab')->asArray()->all(), 'pk_i_id', 's_token_count_slab'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Select Slab2'],
        'format'=>'raw'
    ],
   
     [
        'attribute'=>'i_token_count_slab3_id', 
        'vAlign'=>'middle',
        'width'=>'7%',
        'value'=>function ($model, $key, $index, $widget) { 
            return TokenCounts::findOne($model->i_token_count_slab3_id)->s_token_count_slab;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(TokenCounts::find()->where('dt_deleted_at IS NULL')->orderBy('s_token_count_slab')->asArray()->all(), 'pk_i_id', 's_token_count_slab'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Select Slab3'],
        'format'=>'raw'
    ],
     [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_discounts', 
        'editableOptions'=>[
            'header'=>'Discounts', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'7%',
    ],
    [
            'class'=>'kartik\grid\BooleanColumn',
             'header'=>'Default Billing', 
            'attribute'=>'i_default_billing', 
            'vAlign'=>'middle'
        ], 
//previos code
    // [
    //     'attribute'=>'i_default_billing',
    //     'header'=>'Default Billing',
    //     'filter' => ['0'=>'No', '1'=>'Yes'],
    //     'format'=>'raw',    
    //     'value' => function($model, $key, $index)
    //       { 
    //        if($model->i_default_billing == '0')
    //        {
    //         return "No";
    //         }
    //        elseif($model->i_default_billing == '1')
    //        {   
    //         return "Yes";
    //        }
    //     	else
    //     	{
    //     	return "--";
    //     	}
    //     },
    //  ],
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
    'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> 	Billing Codes</h3>',
    'footer'=>false
    ],
    'persistResize'=>false,
    'exportConfig'=>true,
    
]);
?>   

</div>
</div>
</div>
</section>

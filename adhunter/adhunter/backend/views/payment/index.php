<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\widgets\Typeahead;
use webvimark\modules\UserManagement\models\User;
use backend\models\Company;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PaymentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payments';
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
    //[
    //    'class'=>'kartik\grid\ExpandRowColumn',
    //    'width'=>'45px',
    //    'value'=>function ($model, $key, $index, $column) {
    //        return GridView::ROW_COLLAPSED;
    //    },
    //    'detail'=>function ($model, $key, $index, $column) {
    //        return Yii::$app->controller->renderPartial('_expand-row-details', ['model'=>$model]);
    //    },
    //    'headerOptions'=>['class'=>'kartik-sheet-style'], 
    //    'expandOneOnly'=>true
    //],
   
    [
        'attribute'=>'fk_i_purchase_order_id', 
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'15%',
    ],
  	[
  		'attribute'=>'fk_i_invoice_id',
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'15%',
  	],
  	
	[
          'attribute' => 's_payment_type',
          'value' => function ($model, $key, $index, $widget) {
           return $model->s_payment_type == 1 ? 'Credit/Debit Card' : ($model->s_payment_type == 2 ? 'Check' : 'Cash');
          //return $model->b_payments_successful == 1 ? 'Pending' : ($model->b_payments_successful == 2 ? 'Paid' : '--');
              },
              'width'=>'20%',
              'vAlign'=>'middle',
              'format'=>'raw',
              'filterType'=>GridView::FILTER_SELECT2,
              'filter' => array(''=>'Select Status','1'=>'Credit/Debit Card', '2'=>'Check', '3'=>'Cash'),
      ],
  		
  	[
  		'attribute'=>'fk_i_user_id',
  		'vAlign'=>'middle',
  		'width'=>'20%',
  		'value'=>function ($model, $key, $index, $widget) {
  		 return Company::findOne($model->fk_i_user_id)->name;
  		},
  		'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(Company::find()->where('dt_deleted_at IS NULL')->orderBy('name')->asArray()->all(), 'id', 'name'), 
  		'filterWidgetOptions'=>[
  				'pluginOptions'=>['allowClear'=>true],
  		],
  		'filterInputOptions'=>['placeholder'=>'Select Comapny'],
  		'format'=>'raw'
  	],
  				
  	[
  		'attribute'=>'f_amount',
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'15%',
  	],

       [
          'attribute' => 'b_payments_successful',
          'value' => function ($model, $key, $index, $widget) {
           //return $model->i_status == 1 ? 'Requested(1)' : ($model->i_status == 2 ? 'Inactive(2)' : 'Completed(3)');
          return $model->b_payments_successful == 1 ? 'Pending' : ($model->b_payments_successful == 2 ? 'Paid' : '--');
              },
              'width'=>'15%',
              'vAlign'=>'middle',
              'format'=>'raw',
              'filterType'=>GridView::FILTER_SELECT2,
              'filter' => array(''=>'Select Status','1'=>'Pending','2'=>'Paid'),
       ],

  	//[
  	//	'attribute'=>'b_payments_successful',
  	//	'vAlign'=>'middle',
  	//	'width'=>'11%',
  	//	//'value'=>function ($model, $key, $index, $widget) {
  	//	//return TokenCounts::findOne($model->s_payment_type)->s_payment_type;
  	//	//},
  	//	'filterType'=>GridView::FILTER_SELECT2,
  	//	//'filter'=>ArrayHelper::map(TokenCounts::find()->orderBy('s_token_count_slab')->asArray()->all(), 'pk_i_id', 's_token_count_slab'),
  	//	'filterWidgetOptions'=>[
  	//			'pluginOptions'=>['allowClear'=>true],
  	//	],
  	//	'filterInputOptions'=>['placeholder'=>'Select Status'],
  	//	'format'=>'raw'
  	//],
  	//	
  
    [

        'class'=>'kartik\grid\ActionColumn',
    ],
 
];

?>   
   
 <?php echo GridView::widget([
    'id' => 'payments-list',
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
    'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> 	Payments</h3>',
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

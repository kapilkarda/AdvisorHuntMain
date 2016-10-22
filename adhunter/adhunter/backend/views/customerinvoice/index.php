<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use kartik\widgets\Typeahead;
use webvimark\modules\UserManagement\models\User;
use backend\models\Company;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerinvoiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customerinvoices';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="box box-primary">

 <div class="box-body biling-code-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
  <?php  $gridColumns = [
    [
        'class'=>'kartik\grid\SerialColumn',
        'contentOptions'=>['class'=>'kartik-sheet-style'],
        'width'=>'40px',
        'header'=>'',
        'headerOptions'=>['class'=>'kartik-sheet-style']
    ],
  	[
  		'attribute'=>'fk_i_company_id',
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'20%',
  		'value'=>function ($model, $key, $index, $widget) {
  			return Company::findOne($model->fk_i_company_id)->name;
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
		'attribute'=>'dt_invoice_date',
		'filterType'=>GridView::FILTER_DATE,
    'filterWidgetOptions' => [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
        ],
    ],    
		'format'=>'date',
		'hAlign'=>'center',
		'vAlign'=>'middle',
		'width'=>'20%',
		'filterWidgetOptions'=>[
			'pluginOptions'=>['format'=>'yyyy-mm-dd']
		],
      ],
  		
  	[
  		'attribute'=>'i_invoice_tot_amt',
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'10%',
  	],
  				
  	[
  		'attribute'=>'f_invoice_paid_amt',
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'10%',
  	],

    [
  		'attribute'=>'f_invoice_due_amt',
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'10%',
    ],
  	[
  		'attribute'=>'dt_paid_date',
  		'format'=>'date',
  		'filterType'=>GridView::FILTER_DATE,
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'20%',
  		'filterWidgetOptions'=>[
  			'pluginOptions'=>['format'=>'yyyy-mm-dd']
  		],
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
    'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> 	Invoice</h3>',
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



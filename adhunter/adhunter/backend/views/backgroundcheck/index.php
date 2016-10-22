<?php

use yii\helpers\Html;
use kartik\editable\Editable;
use kartik\grid\GridView;
use backend\models\Company;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BackgroundCheckSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Background Checks';
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
//     [
//         'class'=>'kartik\grid\SerialColumn',
//         'contentOptions'=>['class'=>'kartik-sheet-style'],
//         'width'=>'36px',
//         'header'=>'',
//         'headerOptions'=>['class'=>'kartik-sheet-style']
//     ],
    
    [
    	   'attribute'=>'fk_i_company_id',
    		'value'=>function ($model, $key, $index, $widget) {
            return  Company::findOne($model->fk_i_company_id)->name;
    	},

        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'20%',
    ],
    
     [
        // 'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'dt_bg_check_date', 
        // 'editableOptions'=>[
        //     'header'=>'Description', 
        //     'size'=>'md',
        // ],
        'format' => 'date',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'15%',
    ],
      [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_bg_check_agency', 
        'editableOptions'=>[
            'header'=>'Image', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'15%',
    ],
        [

        'attribute'=>'s_bg_check_report_image', 
        'value'=>function ($model, $key, $index, $widget) {
        return Html::img(Yii::$app->get('s3bucket')->getUrl('back_check_image/thumbs/'.$model->s_bg_check_report_image), [
          
            'width'=>'100',
            'alt'=>Yii::t('app', 'Avatar for ') . $model->s_bg_check_report_image,
           // 'title'=>Yii::t('app', 'Click remove button below to remove this image'),
            'class'=>'attachment-img'
            // add a CSS class to make your image styling consistent
                    ]);
             },
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'15%',
        'format'=>'html'
    ],
    [
       	// 'class'=>'kartik\grid\EditableColumn',
       	'attribute'=>'i_bg_check_status',
        'value' => function ($model, $key, $index, $widget) {
                return $model->i_bg_check_status == 1 ? 'Received' : ($model->i_bg_check_status == 2 ? 'In-Review' : ($model->i_bg_check_status == 3 ? 'Approved': 'Null'));
            },
       	// 'editableOptions'=>[
       	// 		'header'=>'Show Front Page',
       	// 		'size'=>'sm',
       	// ],
       	'hAlign'=>'center',
       	'vAlign'=>'middle',
       	'width'=>'15%',
       	],
       	[
       	'class'=>'kartik\grid\EditableColumn',
       	'attribute'=>'s_bg_check_comments',
       	'editableOptions'=>[
       			'header'=>'Show Front Page',
       			'size'=>'sm',
       	],
       	'hAlign'=>'center',
       	'vAlign'=>'middle',
       	'width'=>'15%',
       	],
       	[
       	// 'class'=>'kartik\grid\EditableColumn',
       	'attribute'=>'s_bg_check_validity',
       	// 'editableOptions'=>[
       	// 		'header'=>'Show Front Page',
       	// 		'size'=>'sm',
       	// ],
        'format' => 'date',
       	'hAlign'=>'center',
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
    //'filterModel'=>$searchModel,
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
    'hover'=>true,
    'showPageSummary'=>false,
    'panel'=>[
        'type'=>GridView::TYPE_PRIMARY,
    	'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Background Check</h3>',
    	'footer'=>false
    ],
    'persistResize'=>false,
    'exportConfig'=>true,
    
]);
?>  
</div>
</div>
</section>


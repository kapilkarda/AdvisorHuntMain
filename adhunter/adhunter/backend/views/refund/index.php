<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use kartik\grid\GridView;
use backend\models\Company;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RefundSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Refunds';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-body refund-index"> 

<?php

    $gridColumns = [
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
    //[
    //    'attribute'=>'fk_i_pro_id', 
    //    'vAlign'=>'middle',
    //    'width'=>'180px',
    //    'header'=>'Company', 
    //    'value'=>function ($model, $key, $index, $widget) { 
    //        return Html::a(Company::findOne($model->fk_i_pro_id)->name,  
    //            '#', 
    //            ['title'=>'View author detail']);
    //    },
    //    'format'=>'raw'
    //],
     [
        'attribute'=>'fk_i_pro_id', 
        'vAlign'=>'middle',
        'width'=>'180px',
        'header'=>'Company', 
        'value'=>function ($model, $key, $index, $widget) { 
            return Company::findOne($model->fk_i_pro_id)->name;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.name FROM company as u WHERE u.dt_deleted_at IS NULL')->queryAll(), 'id', 'name'),            
          'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Company'],
        'format'=>'raw'
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'fk_i_project_id',
        'vAlign'=>'middle',
        'width'=>'100px',
        'editableOptions'=> function ($model, $key, $index){
            return [
                'header'=>'Lead', 
                'size'=>'md',
            ];
        }
    ],


    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'fk_i_bid_id', 
        'vAlign'=>'middle',
        'hAlign'=>'right', 
        'width'=>'7%',
        'format'=>'raw',
            'editableOptions'=> function ($model, $key, $index){
            return [
                'header'=>'Bid', 
                'size'=>'sm',
            ];
        }
    ],

     [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_description', 
        'vAlign'=>'middle',
        'hAlign'=>'right', 
        'width'=>'7%',
        'format'=>'raw',
            'editableOptions'=> function ($model, $key, $index){
            return [
                'header'=>'Description', 
                'size'=>'sm',
            ];
        }
    ],

    //[
    //    'class'=>'kartik\grid\EditableColumn',
    //    'attribute'=>'i_refund_status', 
    //    'vAlign'=>'middle',
    //    'hAlign'=>'right', 
    //    'width'=>'7%',
    //    'format'=>'raw',
    //        'editableOptions'=> function ($model, $key, $index){
    //        return [
    //            'header'=>'Status', 
    //            'size'=>'sm',
    //        ];
    //    }
    //],
     [
    'attribute' => 'i_refund_status',
    'value' => function ($model, $key, $index, $widget) {
     return $model->i_refund_status == 1 ? 'Requested' : ($model->i_refund_status == 2 ? 'Canceled' : ($model->i_refund_status == 3 ? 'Refunded': 'Null'));
        
            
        },
        'width'=>'13%',
        'vAlign'=>'middle',
        'format'=>'raw',
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => array(''=>'Select Status','1'=>'Requested','2'=>'Canceled','3'=>'Refunded'),
    //ArrayHelper::map($var,'id', 'name'),['class'=>'form-control','prompt' => 'Select Status']),
    ],


    [

        'class'=>'kartik\grid\ActionColumn',
    ],
    [
        'class'=>'kartik\grid\CheckboxColumn',
        'headerOptions'=>['class'=>'kartik-sheet-style'],
    ],
    ];
    ?>

    <?php echo GridView::widget([
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


</div>
</div>
</section>

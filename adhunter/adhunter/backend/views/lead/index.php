<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\models\Subcategory;
use webvimark\modules\UserManagement\models\User;
use backend\models\City;
use kartik\editable\Editable;
use yii\helpers\ArrayHelper;
use backend\models\Lead;
use kartik\widgets\Typeahead;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\LeadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leads';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-body lead-index"> 

<?php
$data=ArrayHelper::map(City::find()->all(),  'name','id');
$gridColumns = [
	[
		'class' => '\kartik\grid\CheckboxColumn'
	],
//     [
//         'class'=>'kartik\grid\SerialColumn',
//         'contentOptions'=>['class'=>'kartik-sheet-style'],
//         'width'=>'36px',
//         'header'=>'',
//         'headerOptions'=>['class'=>'kartik-sheet-style']
//     ],
   
    [
        'class'=>'kartik\grid\ExpandRowColumn',
        'width'=>'45px',
        'value'=>function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detail'=>function ($model, $key, $index, $column) {
            return Yii::$app->controller->renderPartial('_expand-row-details', ['model'=>$model]);
        },
        'headerOptions'=>['class'=>'kartik-sheet-style'], 
        'expandOneOnly'=>true
    ],
   
    
    [
        'attribute'=>'fk_i_requested_by', 
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>function ($model, $key, $index, $widget) { 
            return User::findOne($model->fk_i_requested_by)->email;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        // 'filter'=>ArrayHelper::map(User::find()->orderBy('email')->asArray()->all(), 'id', 'email'), 
        'filter'=>ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.email FROM user as u, auth_assignment as role  WHERE u.id = role.user_id AND role.item_name = "Customer" AND u.dt_deleted_at IS NULL')->queryAll(), 'id', 'email'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Users'],
        'format'=>'raw'
    ],
    
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_name',
        'vAlign'=>'middle',
        'width'=>'210px',
        'editableOptions'=> function ($model, $key, $index){
            return [
                'header'=>'Name', 
                'size'=>'md',
            ];
        }
    ],

    [
    'attribute' => 'fk_i_sub_category_id',
    'value' => function ($model, $key, $index, $widget) {
            return  SubCategory::findOne($model->fk_i_sub_category_id)->name;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Subcategory::find()->where('dt_deleted_at IS NULL')->orderBy('name')->asArray()->all(), 'id', 'name'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Sub Category'],
        'format'=>'raw'
    ],

    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_address', 
        'editableOptions'=>[
            'header'=>'Address', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'20%',
    ],
 
    [
       'attribute' => 'fk_i_city_id',
       'value' => function ($model, $key, $index, $widget) {
            return  City::findOne($model->fk_i_city_id)->name;
        },
        'width'=>'13%',
        'vAlign'=>'middle',
        'format'=>'raw',
        'filterType'=>GridView::FILTER_TYPEAHEAD,
        'filterWidgetOptions'=>[
            'pluginOptions' =>['highlight' =>true],
            'dataset'=>[['local' =>array_values(City::find()->select('name')->where('dt_deleted_at IS NULL')->column())]
        ]],
        'filterInputOptions'=>['placeholder'=>'Type City'],
        'format'=>'raw'
    ],
    
    [
        'attribute' => 'i_status',
        'value' => function ($model, $key, $index, $widget) {
         //return $model->i_status == 1 ? 'Requested(1)' : ($model->i_status == 2 ? 'Inactive(2)' : 'Completed(3)');
        return $model->i_status == 1 ? 'Requested' : ($model->i_status == 2 ? 'In Progress' : ($model->i_status == 3 ? 'Completed': 'Null'));
            },
            'width'=>'13%',
            'vAlign'=>'middle',
            'format'=>'raw',
            'filterType'=>GridView::FILTER_SELECT2,
            'filter' => array(''=>'Select Status','1'=>'Requested','2'=>'In Progress','3'=>'Completed'),
        //ArrayHelper::map($var,'id', 'name'),['class'=>'form-control','prompt' => 'Select Status']),
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
    		Html::a('<i class="glyphicon glyphicon-ok-sign"></i>',  ['create'],['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>'Reset Grid']) . ' '.
    		Html::a('<i class="glyphicon glyphicon-remove-sign"></i>', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
    	],
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
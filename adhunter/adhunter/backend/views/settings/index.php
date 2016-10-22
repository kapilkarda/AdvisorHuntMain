<?php

use yii\helpers\Html;

use yii\widgets\Pjax;
use kartik\editable\Editable;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-body settings-index">

       <?php  $gridColumns = [
    [
        'class'=>'kartik\grid\SerialColumn',
        'contentOptions'=>['class'=>'kartik-sheet-style'],
        'width'=>'36px',
        'header'=>'',
        'headerOptions'=>['class'=>'kartik-sheet-style']
    ],
    
    [
//         'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_settings_name', 
//         'editableOptions'=>[
//             'header'=>'Name', 
//             'size'=>'md',
//         ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'20%',
    ],
    
     [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_settings_value', 
        'editableOptions'=>[
            'header'=>'Setting Value', 
            'size'=>'md',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'35%',
    ],

    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'b_status', 
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => array(''=>'Select Status','1'=>'Active','0'=>'Inactive'),
        'editableOptions'=>[
            'header' => 'Status',
            'size' => 'sm',
            'inputType' => Editable::INPUT_DROPDOWN_LIST,
            'data' => array('1'=>'active','0'=>'Inactive'),
        ],
        'value' => function ($model, $key, $index, $widget) {
            return $model->b_status == 1 ? 'Active' :  'Inactive';
            },
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
            Html::a('<i class="glyphicon glyphicon-plus"></i>',  ['create'],['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>'Create']) . ' '.
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
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Settings</h3>',
        'footer'=>false
    ],
    'persistResize'=>false,
    'exportConfig'=>true,
    
]);
?>  


</div>
</div>
</section>

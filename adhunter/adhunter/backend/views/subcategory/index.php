<?php

use yii\helpers\Html;
use kartik\editable\Editable;
use kartik\grid\GridView;
use backend\models\Category;
use backend\models\Subcategory;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subcategories';
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
    
    [
//         'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'name', 
//         'editableOptions'=>[
//             'header'=>'Name', 
//             'size'=>'md',
//         ],
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'width'=>'20%',
    ],
    
     [
//         'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'description', 
//         'editableOptions'=>[
//             'header'=>'Description', 
//             'size'=>'md',
//         ],
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'width'=>'35%',
    ],
    [

        'attribute'=>'s_image', 
        'value'=>function ($model, $key, $index, $widget) {
        return Html::img(Yii::$app->get('s3bucket')->getUrl('category/thumbs/'.($model->s_image?$model->s_image:'no_image.jpg')), [
          
            'width'=>'100',
            'alt'=>Yii::t('app', 'Avatar for ') . $model->s_image,
           // 'title'=>Yii::t('app', 'Click remove button below to remove this image'),
            'class'=>'attachment-img'
            // add a CSS class to make your image styling consistent
                    ]);
             },
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'5%',
          'format'=>'html'
    ],
        [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'b_front_page', 
        'value' => function ($model, $key, $index, $widget) {	
        	return $model->b_front_page == 1 ? 'Yes' :  ($model->b_front_page == 0 ? 'No': 'Null');
        	},
         'filterType'=>GridView::FILTER_SELECT2,
        'filter' => array(''=>'Select Status','1'=>'Yes','0'=>'No'),   
        'editableOptions'=>[
            'header' => 'Show on Front Page',
            'size' => 'sm',
            'inputType' => Editable::INPUT_DROPDOWN_LIST,
            'data' => array('1'=>'Yes','0'=>'No'),
        ],
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
    	'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Sub-Category</h3>',
    	'footer'=>false
    ],
    'persistResize'=>false,
    'exportConfig'=>true,
    
]);
?>  
</div>
</div>
</section>




<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhoneTextTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phone Text Templates';
$this->params['breadcrumbs'][] = $this->title;
?>

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
            'width'=>'10%',
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
        ],
     
          [
            'attribute'=>'s_name',
             'label' =>'Name',
            'vAlign'=>'middle',
            'width'=>'35%',

        ],
      [
//             'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'i_template_type',
      		'value' => function ($model, $key, $index, $widget) {
      		//return $model->i_status == 1 ? 'Requested(1)' : ($model->i_status == 2 ? 'Inactive(2)' : 'Completed(3)');
      		return  $model->i_template_type == 0 ? 'Text Message Template' : ($model->i_template_type == 1 ? 'Voice Call Template': 'Null');
      		},
            'label' =>'Template Type',
//             'editableOptions'=>[
//                 'header'=>'Title', 
//                 'size'=>'sm',
//             ],
            'hAlign'=>'left',
            'vAlign'=>'middle',
            'width'=>'40%',
            'filterType'=>GridView::FILTER_SELECT2,
      		'filter' => array(''=>'Select Status','0'=>'Text Message Template','1'=>'Voice Call Template'),
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
    		'footer'=>true	
        ],
        'persistResize'=>false,
        'exportConfig'=>true,
    ]);
    ?>
</div>
</div>

</section>

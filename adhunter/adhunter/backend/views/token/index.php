<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use backend\models\Subcategory;
use yii\helpers\ArrayHelper;
use kartik\editable\Editable;
use kartik\grid\GridView;
use backend\models\Zipcode;
use backend\models\City;
use backend\models\State;
use kartik\widgets\Typeahead;
//use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TokenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tokens';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-body token-index"> 
    <p>
        <?//= Html::a('Create Token', ['create'], ['class' => 'btn btn-success']) ?>
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
        'class' => '\kartik\grid\CheckboxColumn'
    ],
   
   [
        'attribute'=>'fk_i_sub_category_id', 
        'vAlign'=>'middle',
        'width'=>'180px',
        'value'=>function ($model, $key, $index, $widget) { 
            return SubCategory::findOne($model->fk_i_sub_category_id)->name;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(SubCategory::find()->orderBy('name')->where('dt_deleted_at IS NULL')->asArray()->all(), 'id', 'name'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Sub Category'],
        'format'=>'raw'
    ],

    [
       'attribute' => 'state_id',
       'value' => function ($model, $key, $index, $widget) {
            return  State::findOne($model->state_id)->name;
        },
        'width'=>'7%',
        'vAlign'=>'middle',
        'format'=>'raw',
        'filterType'=>GridView::FILTER_TYPEAHEAD,
        
        'filterWidgetOptions'=>[
            //'pluginOptions'=>['allowClear'=>true],
             'pluginOptions' => ['highlight'=>true],
             'dataset'=>[['local' =>array_values(State::find()->select('name')->where('dt_deleted_at IS NULL')->column())]],
            'filterInputOptions'=>['placeholder'=>'Type State'],
            'format'=>'raw'
        ],
    ],    
     
    [
       'attribute' => 'city_id',
       'value' => function ($model, $key, $index, $widget) {
            return  City::findOne($model->city_id)->name;
        },
        'width'=>'7%',
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
            'attribute'=>'fk_i_zip_id',
            'value'=>function ($model, $key, $index, $widget) {
                return  Zipcode::findOne($model->fk_i_zip_id)->zip;
            },
            'width'=>'8%',
            'vAlign'=>'middle',
            'format'=>'raw',
    ],
    
     [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'i_project_cost_range_from', 
        'editableOptions'=>[
            'header'=>'Project Cost Range From', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'14%',
    ],

    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'i_project_cost_range_to', 
        'editableOptions'=>[
            'header'=>'Project Cost Range To', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'14%',
    ],

    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'i_token_count', 
        'editableOptions'=>[
            'header'=>'Token Count', 
            'size'=>'sm',
        ],
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'14%',
    ],
    [

        'class'=>'kartik\grid\ActionColumn',
    ],
 
];

?>
 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar'=> [
        	['content'=>
        		Html::button('Bulk Token update', ['id'=>'update-bulk-token-count', 'class'=>'btn btn-default']) 
        	],
            ['content'=>
               // Html::button('Bulk Token update', ['id'=>'update-bulk-token-count', 'class'=>'btn btn-default']) .  ' &nbsp'.
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
</div></section>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Token Values for Selected records</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="myForm" class="hide">
    <?= Html::beginForm(['token/bulkupdate', 'id' => 'bulk-token-update-form'], 'post') ?>
    <!-- <form action="/echo/html/" id="popForm" method="get"> -->
        <div>

            <label for="email">Select Records Checkbox:</label>
            <?= Html::input('text', 'records', '', ['id' => 'token-records','class'=>'form-control input-md', 'readonly'=>'readonly']) ?>
            
            <label for="email">No of Tokens:</label>
             <?= Html::input('text', 'token_value', '', ['class' => 'form-control input-md']) ?>
            <br>
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        </div>
    <?= Html::endForm() ?>
    <!-- </form> -->
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

         $('#update-bulk-token-count').popover({      
                placement: 'bottom',
                title: 'Update Token values',
                html:true,
                content:  $('#myForm').html()
            });

        $(':checkbox').change(function() {
            var checkedValues = $("input:checkbox[name='selection[]']:checked").map(function() {
                return this.value;
            }).get();
            $('#token-records').val(checkedValues);
            console.log(checkedValues);
        // alert(keys); 
        // console.log( keys);
        });
         
    });
</script>
<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use backend\models\QuestionType;
use backend\models\Question;
use backend\models\Subcategory;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="promo-code-index">-->
<section class="content">
<div class="box box-primary">   
   <div class="box-body"> 
<?php
    $gridColumns = [
        [
            'class'=>'kartik\grid\SerialColumn',
            'contentOptions'=>['class'=>'kartik-sheet-style'],
            'width'=>'5%',
            'header'=>'',
            'headerOptions'=>['class'=>'kartik-sheet-style']
        ],    
        [
            'attribute'=>'question_text',
             'label' =>'Question',
            'vAlign'=>'middle',
            'width'=>'34%',
        ],

        [
            'attribute'=>'question_type_id', 
            'vAlign'=>'middle',
            'width'=>'18%',
            'value'=>function ($model, $key, $index, $widget) { 
                return QuestionType::findOne($model->question_type_id)->name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(QuestionType::find()->orderBy('name')->where('dt_deleted_at IS NULL')->asArray()->all(), 'id', 'name'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Question Type'],
            'format'=>'raw'
        ],

        [
        'value' => function ($model){ return $model->getCategorysByQuestion($model->id); },
        'label' =>'Category',
        'hAlign'=>'left',
        'vAlign'=>'middle',
        'width'=>'18%',
        ],

        [
        'attribute'=>'created_at',
        'filterType'=>GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
            ],
        ],
        'label' =>'Created At',
        'vAlign'=>'middle',
        'width'=>'15%',
        'format'=>'date',
        ],
        [
        'attribute'=>'updated_at',
        'filterType'=>GridView::FILTER_DATE,
        'filterWidgetOptions' => [
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
            ],
        ],
        'value'=>function ($model, $key, $index, $widget) { 
              return \Yii::$app->Helpers->date($model->updated_at);
        },
        'label' =>'Updated at',
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
    		'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '. $this->title . '</h3>',
    		// 'footer'=>true
        ],
        'persistResize'=>false,
        'exportConfig'=>true,
    ]);
    ?>
</div>
</div>

</section>



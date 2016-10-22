<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use backend\models\State;
use backend\models\City;
use backend\models\Country;
use backend\models\Subcategory;
use webvimark\modules\UserManagement\models\User;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-header with-border">
    <h3 class="box-header"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body company-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <!--  <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->
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
    'attribute'=>'user_id', 
    'vAlign'=>'middle',
    'width'=>'180px',
     'value'=>function ($model, $key, $index, $widget) { 
        return Html::a(User::findOne($model->user_id)->email,  
            '#', 
            ['title'=>'View author detail']);
    },
    'format'=>'raw'
],
[
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'name',
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
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'address', 
    'editableOptions'=>[
        'header'=>'Address', 
        'size'=>'md',
    ],
    'hAlign'=>'center',
    'vAlign'=>'middle',
    'width'=>'7%',
],
[
    'attribute'=>'city',
    'value'=>function ($model, $key, $index, $widget) {
        return  City::findOne($model->city_id)->name;
    },
    'width'=>'8%',
    'vAlign'=>'middle',
    'format'=>'raw',
],



[
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'mobile', 
    'vAlign'=>'middle',
    'hAlign'=>'right', 
    'width'=>'7%',
    'format'=>'raw',
        'editableOptions'=> function ($model, $key, $index){
        return [
            'header'=>'Mobile', 
            'size'=>'sm',
        ];
    }
],
[
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'phone', 
    'vAlign'=>'middle',
    'hAlign'=>'right', 
    'width'=>'7%',
    'format'=>'raw',
        'editableOptions'=> function ($model, $key, $index){
        return [
            'header'=>'Phone', 
            'size'=>'sm',
        ];
    }
],
[
    'class'=>'kartik\grid\EditableColumn',
    'attribute'=>'year_founded',    
    'hAlign'=>'center',
    'width'=>'9%',
    'format'=>'raw',
    'editableOptions'=> function ($model, $key, $index){
        return [
            'header'=>'Your Founded', 
            'size'=>'sm',
        ];
    }
],
[
    'class'=>'kartik\grid\BooleanColumn',
     'header'=>'Active', 
    'attribute'=>'active_company_flag', 
    'vAlign'=>'middle'
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
        // 'heading'=>$heading,
    ],
    'persistResize'=>false,
    'exportConfig'=>true,
]);
?>
</div>
</div>
</section>
<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use webvimark\modules\UserManagement\models\User;
use backend\models\Company;
use backend\models\Project;
use kartik\editable\Editable;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyReviewCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Review Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-header"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body company-review-comment-index"> 
       <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


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
                'class'=>'kartik\grid\ExpandRowColumn',
                'width'=>'5%',
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
                'attribute'=>'fk_i_project_id', 
                'vAlign'=>'middle',
                'width'=>'10%',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a(Project::findOne($model->fk_i_project_id)->s_name,  
                        '#', 
                        ['title'=>'View author detail']);
                },
                'format'=>'raw'
            ],
             [
                'attribute'=>'fk_i_company_id', 
                'vAlign'=>'middle',
                'width'=>'10%',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a(Company::findOne($model->fk_i_company_id)->name,  
                        '#', 
                        ['title'=>'View author detail']);
                },
                'format'=>'raw'
            ],
            [
                'attribute'=>'s_review_by', 
                'vAlign'=>'middle',
                'width'=>'10%',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Html::a(User::findOne($model->s_review_by)->email,  
                        '#', 
                        ['title'=>'View User detail']);
                },
                'format'=>'raw'
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'s_review_comment', 
                'vAlign'=>'middle',
                'hAlign'=>'left', 
                'width'=>'40%',
                'format'=>'raw',
                    'editableOptions'=> function ($model, $key, $index){
                    return [
                        'header'=>'Comment', 
                        'size'=>'md',
                    ];
                }
            ],
            [
                'attribute'=>'dt_review_date', 
                'vAlign'=>'middle',
                'hAlign'=>'right', 
                'width'=>'7%',
                'format'=>'raw',
            ],
             [
                'class' => 'kartik\grid\EditableColumn',
                'attribute'=>'i_status', 
                'vAlign'=>'middle',
                'hAlign'=>'right', 
                'width'=>'7%',
                'format'=>'raw',
                'value' => function ($model, $key, $index, $widget) { 
                    return ($model->i_status)?'Active':'Inactive';
                },
                'editableOptions'=> function ($model, $key, $index, $widget) {
                    return [
                            'header' => 'Status',
                            'size' => 'sm',
                            'inputType' => Editable::INPUT_DROPDOWN_LIST,
                            'data' => array('1'=>'active','0'=>'Inactive'),
                    ];
                }
            ],
            // [
            //     'class'=>'kartik\grid\BooleanColumn',
            //     'header'=>'Active', 
            //     'attribute'=>'i_status', 
            //     'vAlign'=>'middle',
                
            // ], 

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
        // 'heading'=>$heading,
    ],
    'persistResize'=>false,
    'exportConfig'=>true,
]);
?>

</div>
</div>
</section>
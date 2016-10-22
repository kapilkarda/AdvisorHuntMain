<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use webvimark\modules\UserManagement\models\User;
use kartik\select2\Select2;
use backend\models\EmailTemplates;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CampaignEmailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Campaign Emails';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary campaign-email-index">

    <div class="box-body company-index">
  

<?php
    //  GridView::widget([
    //     'dataProvider' => $dataProvider,
    //     'filterModel' => $searchModel,
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],

    //         'pk_i_id',
    //         's_name',
    //          's_user_query:ntext',
    //         's_company_query:ntext',
    //         's_email_body:ntext',
    //         's_status',

    //         ['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]); 
?>

<?php
    $gridColumns = [
//         [
//             'class'=>'kartik\grid\SerialColumn',
//             'contentOptions'=>['class'=>'kartik-sheet-style'],
//             'width'=>'4%',
//             'header'=>'',
//             'headerOptions'=>['class'=>'kartik-sheet-style']
//         ],
        // [
        //     'class'=>'kartik\grid\ExpandRowColumn',
        //     'width'=>'5%',
        //     'value'=>function ($model, $key, $index, $column) {
        //         return GridView::ROW_COLLAPSED;
        //     },
        //     'detail'=>function ($model, $key, $index, $column) {
        //         return Yii::$app->controller->renderPartial('_expand-row-details', ['model'=>$model]);
        //     },
        //     'headerOptions'=>['class'=>'kartik-sheet-style'], 
        //     'expandOneOnly'=>true
        // ],
        
        [
            'attribute'=>'fk_i_template_id', 
            'hAlign'=>'center',
  			'vAlign'=>'middle',
  			'width'=>'25%',
            'value'=>function ($model, $key, $index, $widget) { 
                  return EmailTemplates::findOne($model->fk_i_template_id)->s_name;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(EmailTemplates::find()->where('dt_deleted_at IS NULL')->all(), 'pk_i_id','s_name'), 
            'filterWidgetOptions'=>[
                      'pluginOptions'=>['allowClear'=>true],
                  ],
            'filterInputOptions'=>['placeholder'=>'Template'],
            // 'format'=>'raw',
            'label' =>"Template Name",
        ],

        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'s_name',
            'vAlign'=>'middle',
            'width'=>'30%',
            'editableOptions'=> function ($model, $key, $index){
                return [
                    'header'=>'Name', 
                    'size'=>'md',
                ];
            }
        ],
        [
            // 'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'s_status', 
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'width'=>'25%',
        ],
        [
            'value'=>function ($model, $key, $index, $widget) { 
                  return Html::a('Send',  
                ['sendcampaignemail', 'id' => $model->pk_i_id], ['id' => $model->pk_i_id, 'class'=>'btn btn-primary update-criteria-btn']);
            },
            'hAlign'=>'center',
            'vAlign'=>'middle',
            'width'=>'10%',
            'format'=>'html'
        ],
        [

            'class'=>'kartik\grid\ActionColumn',
        ],
    ];
    ?>

    <?php
     echo GridView::widget([
        'id' => 'campaign-email-list',
        'dataProvider'=>$dataProvider,
        'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>false, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>',  ['create'],['data-pjax'=>0, 'class'=>'btn btn-success', 'title'=>'Create Campaign']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Campaign'])
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
    	'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> 	Campaign Emails</h3>',
    	'footer'=>false
    	],
        'persistResize'=>false,
        'exportConfig'=>true,
    ]);
    ?>

</div>


</div>
</section>

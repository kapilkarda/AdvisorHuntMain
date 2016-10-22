<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use webvimark\modules\UserManagement\models\User;
use kartik\grid\GridView;
use backend\models\Company;
use yii\helpers\ArrayHelper;
use kartik\dropdown\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-body project-index"> 
    <?php 
    // GridView::widget([
    //     'dataProvider' => $dataProvider,
    //     'filterModel' => $searchModel,
    //     'columns' => [
    //         ['class' => 'yii\grid\SerialColumn'],

    //         'pk_i_id',
    //         'fk_i_requested_by',
    //         's_name',
    //         'i_type',
    //         'f_cost',
            // 's_duration',
            // 's_description:ntext',
            // 's_address',
            // 'fk_i_zip_id',
            // 'fk_i_company_id',
            // 'dt_created_at',

    //         ['class' => 'yii\grid\ActionColumn'],
    //     ],
    // ]); 

    ?>
</div>
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
   
     [
        'attribute'=>'fk_i_requested_by', 
        'vAlign'=>'middle',
        'width'=>'20%',
        'value'=>function ($model, $key, $index, $widget) { 
            return User::findOne($model->fk_i_requested_by)->email;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.email FROM user as u, auth_assignment as role  WHERE u.id = role.user_id AND role.item_name = "Customer" AND u.dt_deleted_at IS NULL')->queryAll(), 'id', 'email'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Users'],
        'format'=>'raw'
    ],

  
    [
        'attribute'=>'fk_i_company_id', 
        'vAlign'=>'middle',
        'width'=>'20%',
        'value'=>function ($model, $key, $index, $widget) { 
            return Company::findOne($model->fk_i_company_id)->name;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(Company::find()->orderBy('name')->where('dt_deleted_at IS NULL')->asArray()->all(), 'id', 'name'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Company'],
        'format'=>'raw'
    ],
 
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_name',
        'vAlign'=>'middle',
        'width'=>'25%',
        'editableOptions'=> function ($model, $key, $index){
            return [
                'header'=>'Name', 
                'size'=>'md',
            ];
        }
    ],
   
     [
    'attribute' => 'i_type',
    'value' => function ($model, $key, $index, $widget) {
        return $model->i_type ==1 ? 'Residential' : ($model->i_type == 2 ? 'Commercial' : '');
       },
        'width'=>'7%',
        'vAlign'=>'middle',
        'format'=>'raw',
        'filterType'=>GridView::FILTER_SELECT2,
        'filter' => array(''=>'Select Type','1'=>'Residential','2'=>'Commercial'),
    //ArrayHelper::map($var,'id', 'name'),['class'=>'form-control','prompt' => 'Select Status']),
    ],


    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'f_cost', 
        'vAlign'=>'middle',
        'hAlign'=>'right', 
        'width'=>'7%',
        'format'=>'raw',
            'editableOptions'=> function ($model, $key, $index){
            return [
                'header'=>'Cost ', 
                'size'=>'sm',
            ];
        }
    ],

     [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_duration', 
        'vAlign'=>'middle',
        'hAlign'=>'right', 
        'width'=>'7%',
        'format'=>'raw',
            'editableOptions'=> function ($model, $key, $index){
            return [
                'header'=>'Duration', 
                'size'=>'sm',
            ];
        }
    ],
    // [
    //     'attribute'=>'dt_created_at', 
    //     'vAlign'=>'middle',
    //     'hAlign'=>'right', 
    //     'width'=>'7%',
    //     'format'=>'raw',
    // ],
    // [
    //     'attribute'=>'dt_deleted_at', 
    //     'vAlign'=>'middle',
    //     'hAlign'=>'right', 
    //     'width'=>'7%',
    //     'format'=>'raw',
    // ],
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

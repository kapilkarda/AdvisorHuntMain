<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\User;
use backend\models\Zipcode;
use kartik\widgets\Typeahead;
use backend\models\City;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">   
   <div class="box-body"> 
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
            'width'=>'150px',
            'value'=>function ($model, $key, $index, $widget) { 
            //	return print_r(ArrayHelper::map(User::find()->orderBy('email')->asArray()->all(), 'id', 'email'));
            //	return print_r(ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.email FROM user as u, auth_assignment as role  WHERE u.id = role.user_id AND role.item_name = "Customer" AND u.dt_deleted_at IS NULL')->queryAll(), 'id', 'email'));
                return User::findOne($model->user_id)->email;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.email FROM user as u, auth_assignment as role  WHERE u.id = role.user_id AND role.item_name = "Customer" AND u.dt_deleted_at IS NULL')->queryAll(), 'id', 'email'), 
             
            // 'filter'=>ArrayHelper::map(User::find()->orderBy('email')->asArray()->all(), 'id', 'email'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Users'],
            'format'=>'raw'
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'first_name',
            'vAlign'=>'middle',
            'width'=>'10%',
            'editableOptions'=> function ($model, $key, $index){
                return [
                    'header'=>'First Name', 
                    'size'=>'sm',
                ];
            }
        ],
         [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'last_name',
            'vAlign'=>'middle',
            'width'=>'10%',
            'editableOptions'=> function ($model, $key, $index){
                return [
                    'header'=>'Last Name', 
                    'size'=>'sm',
                ];
            }
        ],
          [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'mobile',
            'vAlign'=>'middle',
            'width'=>'10%',
            'editableOptions'=> function ($model, $key, $index){
                return [
                    'header'=>'Mobile', 
                    'size'=>'sm',
                ];
            }
        ],
     
         [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'address', 
            'editableOptions'=>[
                'header'=>'Address', 
                'size'=>'sm',
            ],
            'hAlign'=>'left',
            'vAlign'=>'middle',
            'width'=>'27%',
        ],

        [
		        'attribute'=>'city_id',
		        'value' => function ($model, $key, $index, $widget) {
		            return  City::findOne($model->id)->name;
		        },
		        'filterType'=>GridView::FILTER_TYPEAHEAD,
		        // 'filterType'=>GridView::FILTER_SELECT2,
		        'filterWidgetOptions'=>[
		            'pluginOptions' =>['highlight' =>true],
		            'dataset'=>[['local' =>array_values(City::find()->select('name')->where('dt_deleted_at IS NULL')->column())]
		        ]],
		        'filterInputOptions' =>['placeholder' =>'Type a city'],
		         'width'=>'8%',
            	'vAlign'=>'middle',
		        'format'=>'raw'
		],

        [
            'attribute'=>'zip_id',
            'value'=>function ($model, $key, $index, $widget) {
                return  Zipcode::findOne($model->zip_id)->zip;
            },
            'filterType'=>GridView::FILTER_TYPEAHEAD,
            'filter'=>ArrayHelper::map(Zipcode::find()->where('dt_deleted_at IS NULL')->asArray()->all(), 'id', 'zip'), 
             'filterWidgetOptions'=>[
		            'pluginOptions' =>['highlight' =>true],
		            'dataset'=>[['local' =>ArrayHelper::map(Zipcode::find()->where('dt_deleted_at IS NULL')->asArray()->all(), 'id', 'name'),]
		        ]],
            'width'=>'8%',
            'vAlign'=>'middle',
            'format'=>'raw',
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
    		'footer'=>false
        ],
        'persistResize'=>false,
        'exportConfig'=>true,
    ]);
    ?>

</div>
</div>
</section>

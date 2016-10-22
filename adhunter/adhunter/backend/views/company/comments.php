<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use backend\models\State;
use backend\models\Zipcode;
use backend\models\Country;
use backend\models\Subcategory;
use webvimark\modules\UserManagement\models\User;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-header with-border">
    <h3 class="box-header"><?php echo Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body company-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php

$gridColumns1 = [
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
            return Yii::$app->controller->renderPartial('_expand-comment-details', ['model'=>$model]);
        },
        'headerOptions'=>['class'=>'kartik-sheet-style'], 
        'expandOneOnly'=>true
    ],
    [
        'attribute'=>'user_id', 
        'vAlign'=>'middle',
        'width'=>'180px',
         'value'=>function ($model, $key, $index, $widget) { 
                return User::findOne($model->user_id)->email;
            },
            'filterType'=>GridView::FILTER_SELECT2,
           'filter'=>ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.email FROM user as u, auth_assignment as role  WHERE u.id = role.user_id AND role.item_name = "Provider" AND u.dt_deleted_at IS NULL')->queryAll(), 'id', 'email'), 
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Users'],
            'format'=>'raw'
    ],
    [
        'attribute'=>'name',
        'vAlign'=>'middle',
        'width'=>'210px',
    ],
    [
        'attribute'=>'address', 
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'7%',
    ],
    [
        'attribute'=>'zip_id',
        'value'=>function ($model, $key, $index, $widget) {
            return  Zipcode::findOne($model->zip_id)->zip;
        },
        'width'=>'8%',
        'vAlign'=>'middle',
        'format'=>'raw',
    ],

    [
        'attribute'=>'mobile', 
        'vAlign'=>'middle',
        'hAlign'=>'right', 
        'width'=>'7%',
        'format'=>'raw',
    ],
    [
        'attribute'=>'phone', 
        'vAlign'=>'middle',
        'hAlign'=>'right', 
        'width'=>'7%',
        'format'=>'raw',
    ],
    [
        'attribute'=>'year_founded',    
        'hAlign'=>'center',
        'width'=>'9%',
        'format'=>'raw',
    ],
    [
        'class'=>'kartik\grid\BooleanColumn',
         'header'=>'Active', 
        'attribute'=>'active_company_flag', 
        'vAlign'=>'middle'
    ], 
    // [

    //     'class'=>'kartik\grid\ActionColumn',
    // ],

];
?>

<?php echo GridView::widget([
    'id' => 'company-list',
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns1,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar'=> [
        ['content'=>
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['comments'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
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
<?php

use yii\helpers\Html;
use kartik\grid\GridView;	
use yii\widgets\Pjax;
use backend\models\Company;
use backend\models\Zipcode;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyServiceAreaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Service Areas';
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
        'width'=>'5%',
        'header'=>'',
        'headerOptions'=>['class'=>'kartik-sheet-style']
    ],
    
    [
        //'attribute'=>Company::findOne($data->fk_i_company_id)->namefunction ($data){ return Company::findOne($data->fk_i_company_id)->name;} , 
    	'attribute'=>'fk_i_company_id',
    	//'attribute'=>[Company::findOne($data->fk_i_company_id)->name],
		'value' => function ($data){ return Company::findOne($data->fk_i_company_id)->name;},
		'label' =>'Company',
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'60%',
    ],
    
     [
     	'value' => function ($data){ return Zipcode::findOne($data->fk_i_service_area_zip)->zip;},
     	'label' =>'Zip',
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
    //'filterModel'=>$searchModel,
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
    		//Html::button('New Company Licenses', ['value' => Url::to(['companyservicearea/create']), 'title' => 'Creating New Service Area', 'class' => 'showModalButton btn btn-success', 'id' => 'add-area-btn']). ' '.
    		//Html::button('Add Service Area', ['value' => Url::to(['companyservicearea/create', 'company_id' =>$model->id]), 'title' => 'Creating New Service Area', 'class' => 'showModalButton btn btn-success add-area-btn', 'id' => 'add-area-btn-'.$model->id, 'company' => $model->id]). ' '.
    		//Html::a('<i class="glyphicon glyphicon-plus"></i>',  ['create'],['data-pjax'=>0, 'class'=>'showModalButton btn btn-success', 'title'=>'Creating New license']) . ' '.
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


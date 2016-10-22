<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProjectImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var \frostealth\yii2\aws\s3\Service $s3 */
//$s3 = Yii::$app->get('s3');

$this->title = 'Project Images';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
<div class="box box-primary">

 <div class="box-body biling-code-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
  <?php  
 // $data=ArrayHelper::map(City::find()->all(),  'name','id');

  $gridColumns = [  
  	[
  		'class' => '\kartik\grid\CheckboxColumn'
  	],
  	[
        //'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'s_image', 
       // 'editableOptions'=>[
       //     'header'=>'Image', 
        //    'size'=>'sm',
        //],
    	'value'=>function ($model, $key, $index, $widget) {
    		//return Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('kvgrid', $model->pk_i_id)]);
    		//return Html::tag( "img src=\"dist/img/user2-160x160.jpg\" class=\"img-circle\" alt=\"User Image");
    		// return Html::img('uploads/project_image/thumbs/'.$model->s_image, [
            return Html::img(Yii::$app->get('s3bucket')->getUrl('project_image/thumbs/'.($model->s_image?$model->s_image:'no_image.jpg')), [
          
            'width'=>'100',
            'alt'=>Yii::t('app', 'Avatar for ') . $model->s_image_alt_details,
           // 'title'=>Yii::t('app', 'Click remove button below to remove this image'),
            'class'=>'attachment-img'
            // add a CSS class to make your image styling consistent
    				]);
    		//a($model->s_image,
    				//['test', 'id' => $model->pk_i_id], ['id' => $model->pk_i_id, 'class'=>'btn btn-primary update-criteria-btn', 'action'=>'okokok']);
    		},
        'hAlign'=>'center',
        'vAlign'=>'middle',
        'width'=>'5%',
    	  'format'=>'html'
    ], 		
  				
  	[
  		//'class'=>'kartik\grid\EditableColumn',
  		'attribute'=>'fk_i_project_id',
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'10%',
  	],

  	[
        'attribute'=>'fk_uploaded_by_id', 
        'vAlign'=>'middle',
        'width'=>'20%',
        'value'=>function ($model, $key, $index, $widget) { 
            return User::findOne($model->fk_uploaded_by_id)->email;
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>ArrayHelper::map(User::find()->orderBy('email')->where('dt_deleted_at IS NULL')->asArray()->all(), 'id', 'email'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Users'],
        'format'=>'raw'
    ],
  	[
  		'class'=>'kartik\grid\EditableColumn',
  		'attribute'=>'s_image_alt_details',
  		'editableOptions'=>[
  				'header'=>'ALT Tag',
  				'size'=>'sm',
  		],
  		'hAlign'=>'center',
  		'vAlign'=>'middle',
  		'width'=>'20%',
  	],

  	[
    	'attribute'=>'d_upload_date',
    	'filterType'=>GridView::FILTER_DATE,
      'filterWidgetOptions' => [
      'pluginOptions' => [
          'format' => 'yyyy-mm-dd',
      ],
    ],
    	'hAlign'=>'center',
    	'vAlign'=>'middle',
    	'width'=>'18%',
      'format'=>'date',
  	],
     [
            'class'=>'kartik\grid\BooleanColumn',
             'header'=>'Active', 
            'attribute'=>'b_status', 
            'vAlign'=>'middle'
        ], 
        //previos there were two status blocked and active
  	// [
   //    	//'class'=>'kartik\grid\EditableColumn',
   //    	'attribute'=>'b_status',
   //    	//   	'editableOptions'=>[
   //    			//   			'header'=>'Status',
   //    			//   			'size'=>'sm',
   //    			//   	],
   //    	'value' => function($model, $key, $index)
   //    	{
   //    		if($model->b_status == '0')
   //    		{
   //    			return "Blocked";
   //    		}
   //    		elseif($model->b_status == '1')
   //    		{
   //    			return "Active";
   //    		}
   //    		else
   //    		{
   //    			return "--";
   //    		}
   //    	},
   //    	'hAlign'=>'center',
   //    	'vAlign'=>'middle',
   //    	'width'=>'10%',
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
 	'resizableColumns'=>true,
 	//'resizeStorageKey'=>Yii::$app->user->id . '-' . date("m"),
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar'=> [
    	['content'=>
    		Html::button('<i class="glyphicon glyphicon-ok-sign"></i>', ['id'=>'activate-project-image-active' ,'class'=>'btn btn-success', 'title'=>'Activate Selected Images']) . ' '.
        Html::button('<i class="glyphicon glyphicon-remove-sign"></i>',['id'=>'activate-project-image-deactivate', 'class'=>'btn btn-danger', 'title'=>'Deactivate Selected Images'])
    	],
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
    	'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Project Images</h3>',
    	'footer'=>false
    ],
    'persistResize'=>false,
    'exportConfig'=>true,
    
]);
?>   

</div>
</div>
</div>
</section>

<div id="hide" class="hide">
    <?= Html::beginForm(['project-image/activate', 'id'=>''], 'post',array('id'=>'project-image-select-form-activate') )?>
            <?= Html::input('hidden', 'records', '', ['class'=>'selected-records form-control input-md', 'readonly'=>'readonly']) ?>
    <?= Html::endForm() ?>
</div>

<div id="hide" class="hide">
    <?= Html::beginForm(['project-image/deactivate', 'id'=>''], 'post',array('id'=>'project-image-select-form-deactivate') )?>
            <?= Html::input('hidden', 'records', '', ['class'=>' selected-records form-control input-md', 'readonly'=>'readonly']) ?>
    <?= Html::endForm() ?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

         $('#activate-project-image-active').click(function(){
             $("#project-image-select-form-activate").submit();
         });

          $('#activate-project-image-deactivate').click(function(){
             $("#project-image-select-form-deactivate").submit();
         });

        $(':checkbox').change(function() {
            var checkedValues = $("input:checkbox[name='selection[]']:checked").map(function() {
                return this.value;
            }).get();
            $('.selected-records').val(checkedValues);
            console.log(checkedValues);
        // alert(keys); 
        // console.log( keys);
        });
         
    });
</script>
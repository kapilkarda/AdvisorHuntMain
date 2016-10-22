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
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-body company-index">
  
<?php
 
    $gridColumns = [
        [
            'class' => '\kartik\grid\CheckboxColumn'
        ],
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
                return User::findOne($model->user_id)->email;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            // 'filter'=>ArrayHelper::map(User::find()->orderBy('email')->asArray()->all(), 'id', 'email'), 
            'filter'=>ArrayHelper::map(\Yii::$app->db->createCommand('SELECT u.id, u.email FROM user as u, auth_assignment as role  WHERE u.id = role.user_id AND role.item_name = "Provider" AND u.dt_deleted_at IS NULL')->queryAll(), 'id', 'email'), 
            
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Users'],
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
            'attribute'=>'zip_id',
            'value'=>function ($model, $key, $index, $widget) {
                return Zipcode::findOne($model->zip_id)->zip;
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
                Html::button('<i class="glyphicon glyphicon-ok-sign"></i>', ['id'=>'activate-comapny-image' ,'class'=>'btn btn-success', 'title'=>'Activate Selected Images']) . ' '.
                Html::button('<i class="glyphicon glyphicon-remove-sign"></i>',['id'=>'deactivate-comapny-image', 'class'=>'btn btn-danger', 'title'=>'Deactivate Selected Images'])
            ],
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
    		'footer'=>true
        ],
        'persistResize'=>false,
        'exportConfig'=>true,
    ]);
    ?>
</div>
</div>
</section>
<div id="hide" class="hide">
    <?= Html::beginForm(['company/activate', 'id'=>''], 'post',array('id'=>'company-image-select-form-activate') )?>
            <?= Html::input('hidden', 'records', '', ['class'=>'selected-records form-control input-md', 'readonly'=>'readonly']) ?>
    <?= Html::endForm() ?>
</div>

<div id="hide" class="hide">
    <?= Html::beginForm(['company/deactivate', 'id'=>''], 'post',array('id'=>'company-image-select-form-deactivate') )?>
            <?= Html::input('hidden', 'records', '', ['class'=>' selected-records form-control input-md', 'readonly'=>'readonly']) ?>
    <?= Html::endForm() ?>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script type="text/javascript">
    $(function() {

         $('#activate-comapny-image').click(function(){
             $("#company-image-select-form-activate").submit();
         });

          $('#deactivate-comapny-image').click(function(){
             $("#company-image-select-form-deactivate").submit();
         });

        $(':checkbox').change(function() {
            var checkedValues = $("input:checkbox[name='selection[]']:checked").map(function() {
                return this.value;
            }).get();
            $('.selected-records').val(checkedValues);
            console.log(checkedValues);
        });      
    });
</script>
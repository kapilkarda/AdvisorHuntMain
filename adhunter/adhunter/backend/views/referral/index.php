<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ReferralSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Referrals';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">

<div class="box box-primary">
<div class="box-body token-counts-index">
    
    <?php Pjax::begin(); ?>

      <?php  $gridColumns = [
      [
          'class'=>'kartik\grid\SerialColumn',
          'contentOptions'=>['class'=>'kartik-sheet-style'],
          'width'=>'40px',
          'header'=>'',
          'headerOptions'=>['class'=>'kartik-sheet-style']
      ],

      [
              'attribute'=>'fk_i_requested_user_id', 
              'vAlign'=>'middle',
              'width'=>'180px',
              'value'=>function ($model, $key, $index, $widget) { 
                  return User::findOne($model->fk_i_requested_user_id)->email;
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
          'attribute' => 'i_referral_status',
          'value' => function ($model, $key, $index, $widget) {
           //return $model->i_status == 1 ? 'Requested(1)' : ($model->i_status == 2 ? 'Inactive(2)' : 'Completed(3)');
          return $model->i_referral_status == 1 ? 'Sent' : ($model->i_referral_status == 2 ? 'In Progress' : '--');
              },
              'width'=>'13%',
              'vAlign'=>'middle',
              'format'=>'raw',
              'filterType'=>GridView::FILTER_SELECT2,
              'filter' => array(''=>'Select Status','1'=>'Sent','2'=>'Signed Up'),
      ],

      [
          'class'=>'kartik\grid\EditableColumn',
          'attribute'=>'s_referral_sent_to_name', 
          'editableOptions'=>[
              'header'=>'Referrel Sent To Name', 
              'size'=>'sm',
          ],
          'hAlign'=>'center',
          'vAlign'=>'middle',
          'width'=>'11%',
      ],

      [   
          'class'=>'kartik\grid\EditableColumn',
          'attribute'=>'s_referral_sent_to_email', 
          'editableOptions'=>[
              'header'=>'Referrel Sent To Email', 
              'size'=>'sm',
          ],
          'hAlign'=>'center',
          'vAlign'=>'middle',
          'width'=>'11%',
      ],

      [
          'class'=>'kartik\grid\EditableColumn',
          'attribute'=>'s_referral_sent_to_mobile', 
          'editableOptions'=>[
              'header'=>'Referrel Sent To Mobile', 
              'size'=>'sm',
          ],
          'hAlign'=>'center',
          'vAlign'=>'middle',
          'width'=>'11%',
      ],
      
      [
          'attribute'=>'dt_referral_sent_date', 
          'filterType'=>GridView::FILTER_DATE,
          'filterWidgetOptions' => [
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'opens' => 'left',
                ],
          ],
      	  'format'=>'date',
          'value'=>function ($model, $key, $index, $widget) { 
              return Yii::$app->Helpers->date($model->dt_referral_sent_date);
          },
          'hAlign'=>'center',
          'vAlign'=>'middle',
          'width'=>'20%',
      ],
      
      [

          'class'=>'kartik\grid\ActionColumn',
      ],
   
  ];

  ?>   
      
   <?php echo GridView::widget([
      'id' => 'referrel-list',
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
<?php Pjax::end(); ?>
    
</div>
</div>


</section>






<?php

use yii\helpers\Html;
use backend\models\Zipcode;
use backend\models\TokenBalance;
use webvimark\modules\UserManagement\models\User;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\Company;
use kartik\popover\PopoverX;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Token Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="content">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-header"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body token-management-index">
<?php
    yii\bootstrap\Modal::begin(['id' =>'modal']);
    yii\bootstrap\Modal::end();
?>
    <?php
 



$gridColumns = [
    [
        'class'=>'kartik\grid\SerialColumn',
        'contentOptions'=>['class'=>'kartik-sheet-style'],
        'width'=>'4%',
        'header'=>'',
        'headerOptions'=>['class'=>'kartik-sheet-style']
    ],  
    [
        'attribute'=>'user_id', 
        'vAlign'=>'middle',
        'width'=>'15%',
        'value'=>function ($model, $key, $index, $widget) { 
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
        'attribute'=>'name',
        'vAlign'=>'middle',
        'width'=>'10%',
       
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
        'attribute'=>'mobile', 
        'vAlign'=>'middle',
        'hAlign'=>'right', 
        'width'=>'7%',
        'format'=>'raw',      
    ],
    [
        'vAlign'=>'middle',
        'hAlign'=>'right', 
        'width'=>'10%',
        'value'=>function ($model, $key, $index, $widget) { 
        $balance =  TokenBalance::find()->where(['fk_i_user_id' => $model->id])->asArray()->one();
            // print_r($balance['i_current_balance']);
            if($balance){
                 return $balance['i_current_balance'];
            }               
        },
        'header'=>'Token Balance',
        'headerOptions'=>['class'=>'kartik-sheet-style']
    ],
    [
      'value'=>function ($model, $key, $index, $widget) { 
            if($model->closed_company_flag == 0)
                return Html::a('Close Account',  
                    ['company/closeaccount', 'id' => $model->id], ['id' => $model->id, 'class'=>'btn btn-primary update-criteria-btn btn-sm']);
            else
                return 'Closed';
        },
        'header'=>'Account Status',
      'hAlign'=>'center',
      'vAlign'=>'middle',
      'width'=>'%',
      'format'=>'html',
    ],
    [
      'value'=>function ($model, $key, $index, $widget) { 

            //  Html::a('Promotional', ['company/promotional-token', 'id' => $model->id], ['class' => 'showModalButton btn btn-success', 'id' => 'add-license-btn']); 
            // return Html::button('New Company Licenses', ['value' => Url::to(['companylicense/create']), 'title' => 'Creating New license', 'class' => 'showModalButton btn btn-success', 'id' => 'add-license-btn']); 
           // return '<a id="add-promo" onclick="myFunction(event);">Item</a>';
            //return '<a id="ok" class="add-promo btn btn-primary btn-sm">promotional</a>';
            return Html::a('Promotional',  
            ['company/promotional-token', 'id' => $model->id], ['id'=>'fff', 'class'=>'add-promo btn btn-primary btn-sm']);
        },
      'hAlign'=>'center',
      'vAlign'=>'middle',
      'width'=>'6%',
      'format'=>'html',
     ],
     [
      'value'=>function ($model, $key, $index, $widget) { 
        return Html::a('Partial Refund',  
        ['partialrefund', 'id' => $model->id], ['id' => 'partial-btn'.$model->id, 'class'=>'partial-btn btn btn-primary update-criteria-btn btn-sm']);
        },
      'hAlign'=>'center',
      'vAlign'=>'middle',
      'width'=>'6%',
      'format'=>'html'
    ],
  
     [
      'value'=>function ($model, $key, $index, $widget) { 
        return Html::a('Full Refund',  
        ['fullrefund', 'id' => $model->id], ['id' => 'fullrefund-btn'.$model->id, 'class'=>'fullrefund-btn btn btn-primary update-criteria-btn btn-sm']);
        },
      'hAlign'=>'center',
      'vAlign'=>'middle',
      'width'=>'6%',
      'format'=>'html'
    ], 
];
?>

<?php 
    echo 
    GridView::widget([
    'id' => 'company-list',
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], 
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>false, 
    'toolbar'=> [
        ['content'=>
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['tokenmanagement'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
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
</script>
</div>
</div>
</section>
<script type="text/javascript">
    $(function(){

        $('.partial-btn').on('click',function () {
         var form = $(this);
         alert("dsdsds"); return false;
         // submit form
             $.ajax({
                  url: form.attr('action'),
                  type: 'post',
                  data: form.serialize(),
                  success: function (response) {
                       if(response == 1){
                            // $(form).trigger("reset");
                            alert("Recored Inserted !!!");
                             $.pjax.reload({container : '#company-list'});     
                       }
                       else{
                           console.log("Failed !!!");
                       }
                  }
             });
             return false;
        });
    });       
</script>
<?php
use yii\bootstrap\modal;
use yii\helpers\Url;
use yii\helpers\html;
use yii\widgets\ActiveForm;
use backend\models\CompanyReviewByExternalCompany;
use backend\models\CompanyRating;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use webvimark\modules\UserManagement\models\User;
use backend\models\Company;
use backend\models\Project;
use kartik\editable\Editable;
use backend\models\CompanyReviewComment;
use backend\models\CompanyReviewCommentSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
        // $comment_searchModel = new CompanyReviewCommentSearch();
        // $comment_dataProvider = $comment_searchModel->search(Yii::$app->request->queryParams);

          $query = CompanyReviewComment::find()->where(['fk_i_company_id' => $model->id])->andWhere('dt_deleted_at IS NULL');

          $comment_dataProvider = new ActiveDataProvider([
              'query' => $query,
              'pagination' => [
                  'pageSize' => 10,
              ],
          ]);


?>
 <div class="row">
   <div class="col-md-12"> 
   <div class="expand" style="padding: 0 100px;">
    <?php
        $gridColumns1 = [
            // [
            //     'attribute'=>'fk_i_company_id', 
            //     'vAlign'=>'middle',
            //     'width'=>'10%',
            //     'value'=>function ($model, $key, $index, $widget) { 
            //         return Company::findOne($model->fk_i_company_id)->name;
            //     },
            //     'format'=>'raw'
            // ],
            [
                'attribute'=>'fk_i_project_id', 
                'vAlign'=>'middle',
                'width'=>'10%',
                'value'=>function ($model, $key, $index, $widget) { 
                    return Project::findOne($model->fk_i_project_id)->s_name;
                },
                'format'=>'raw',
            ],
             
            [
                'attribute'=>'s_review_by', 
                'vAlign'=>'middle',
                'width'=>'10%',
                'value'=>function ($model, $key, $index, $widget) { 
                    return User::findOne($model->s_review_by)->email;
                },
                'format'=>'raw',
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
                },
            ],
            [
                'attribute'=>'dt_review_date', 
                'vAlign'=>'middle',
                'hAlign'=>'right', 
                'width'=>'7%',
                'format'=>'date',
            ],
            [
                'header'=>'Rating',
                'vAlign'=>'middle',
                'hAlign'=>'right', 
                'width'=>'8%',
                'format'=>'raw',
                'value'=>function ($model, $key, $index, $widget) { 
                    $ratings =ArrayHelper::map(CompanyRating::find()->orderBy('dt_review_date')->where(['fk_i_comment_id' => $model->pk_i_id])->asArray()->all(), 's_rating_category', 'i_rating');
                    $rate ="";
                    foreach(CompanyRating::find()->orderBy('dt_review_date')->where(['fk_i_comment_id' => $model->pk_i_id])->asArray()->all() as $row){
                          $rate .= "".$row['s_rating_category']." : ".$row['i_rating']."<br>"; 
                    }
                   return $rate;
                },               
            ],
            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute'=>'i_status', 
                'vAlign'=>'middle',
                'hAlign'=>'right', 
                'width'=>'5%',
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
                },
            ],       
        ];
?>
<?php echo GridView::widget([
    'id' => 'company-list',
    'dataProvider'=>$comment_dataProvider,
    'columns'=>$gridColumns1,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    // 'pjax'=>true, // pjax is set to always true for this demo

    'bordered'=>true,
    'striped'=>true,
    'condensed'=>false,
    'responsive'=>true,
    'hover'=>true,
]);
?>

    </div>
    </div>
</div>   



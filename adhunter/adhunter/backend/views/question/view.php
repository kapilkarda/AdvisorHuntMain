<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\QuestionType;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
 <section class="content">
	 <div class="row">
			<div class="col-md-2">
			</div>
		<div class="col-md-7">
			<div class="box box-primary promo-code-view">
		    	<div class="box-header with-border">
		    		<h5 class="box-title"><?= Html::encode($this->title) ?></h5>
		   	 	</div>
				<div class="box-body">
				
				    <p>
				        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
				        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
				            'class' => 'btn btn-danger',
				            'data' => [
				                'confirm' => 'Are you sure you want to delete this item?',
				                'method' => 'post',
				            ],
				        ]) ?>
				    </p>
				
				    <table class = "table table-striped"> 
				       <thead>
				          <tr>
				             <th>ID</th>
				             <td><?php echo $model->id; ?></td>
				          </tr>
				       </thead>
				            
				       <tbody>
				          <tr>
				            <th>Question Text</th>
				             <td><?php echo $model->question_text; ?></td>
				          </tr>
				          
				          <tr>
		                             <th>Question Type</th>
				             <td><?php echo $model->question_type->name; ?></td>
				          </tr>
				          
				          <tr>
				             <th>Sub Categroy</th>
				             <td><?php echo $model->getCategorysByQuestion($model->id); ?></td>
				          </tr>
				          <tr>
				            <th>Options :</th>
				             <td><?php echo $model->getAnswersByQuestion($model->id); ?></td>
				          </tr>
				          
				          <tr>
				            <th>Created At</th>
				             <td><?php echo $model->created_at; ?></td>
				          </tr>
				          
				          <tr>
				             <th>Updated At </th>
				             <td><?php echo $model->updated_at; ?></td>
				          </tr>
				       </tbody>       
				    </table>
				</div>
		</div>
	</div>
	</div>

</section>

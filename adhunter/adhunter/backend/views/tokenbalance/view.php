<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TokenBalance */

$this->title = $model->pk_i_id;
$this->params['breadcrumbs'][] = ['label' => 'Token Balances', 'url' => ['index']];
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
        			<?= Html::a('Update', ['update', 'id' => $model->pk_i_id], ['class' => 'btn btn-primary']) ?>
        			<?= Html::a('Delete', ['delete', 'id' => $model->pk_i_id], [
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
				             <td><?php echo $model->pk_i_id; ?></td>
				          </tr>
				       </thead>
				            
				       <tbody>
				          <tr>
				            <th>Question Text</th>
				             <td><?php echo $model->fk_i_user_id; ?></td>
				          </tr>
				          
				          <tr>
				            <th>Question Type</th>
				             <td><?php echo $model->i_prev_balance; ?></td>
				          </tr>
				          
				          <tr>
				             <th>Sub Categroy</th>
				             <td><?php echo $model->i_current_balance; ?></td>
				          </tr>
				          <tr>
				            <th>Options :</th>
				             <td><?php echo $model->dt_last_purchase_date; ?></td>
				          </tr>
				          
				          <tr>
				            <th>Created At</th>
				             <td><?php echo $model->dt_last_used_date; ?></td>
				          </tr>

				       </tbody>       
				    </table>
				</div>
		</div>
	</div>
	</div>

</section>




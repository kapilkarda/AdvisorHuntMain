<?php
//use backend\models\Bid;
use backend\models\Lead;
use backend\models\UserDetails;


$user = $model->user_id;
$model = new Lead();
$leads = Lead::find()
    ->where(['fk_i_requested_by' => $user])
    ->orderBy('pk_i_id')
    ->all();

//print_r($bids);die("$$$");
?>
<h5>Lead Details :</h5>
<table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Sub Category</th>
        <th>Created Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($leads as $lead) {
    ?>
      <tr class="success">
        <td><?php echo $lead->s_name;?></td>
        <td><?php
	if($lead->fk_i_sub_category_id == 1)
	{ echo "Roofing"; }  
	elseif($lead->fk_i_sub_category_id == 2)
	{echo "External"; }
	elseif($lead->fk_i_sub_category_id == 3)
	{ echo "Kichen Cleaning";}
	elseif($lead->fk_i_sub_category_id == 4)
	{ echo "Cleaning Roof"; }
	elseif($lead->fk_i_sub_category_id == 5)
	{ echo "New SubCategory";}
        elseif($lead->fk_i_sub_category_id == 6)
	{ echo "Pest Control"; }
	else
	{ echo "--";}
	//echo $lead->fk_i_sub_category_id; ?></td>
        <td><?php echo $lead->dt_date_created; ?></td>
        <td><?php
	if($lead->i_status == 1)
	{ echo "Requested"; }
	elseif($lead->i_status == 2)
	{echo "In Progress"; }
	elseif($lead->i_status == 3)
	{echo "Completed"; }
	else
	{
	    echo "--"; 
	}
	//echo $lead->i_status; ?>

       
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>


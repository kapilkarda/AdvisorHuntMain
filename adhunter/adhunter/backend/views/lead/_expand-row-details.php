<?php
use backend\models\Bid;
use backend\models\Company;

$bids = Bid::find()
    ->where(['fk_i_lead_id' => $model->pk_i_id])
    ->orderBy('pk_i_id')
    ->all();

// print_r($bids);
?>
<h5>Bids :</h5>
<table class="table">
    <thead>
      <tr>
        <th>Company</th>
        <th>Date</th>
         <th>Token used</th>
        <th>Ip Address</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($bids as $bid) {
    ?>
      <tr class="success">
        <td><?php echo Company::findOne($bid->fk_i_user_id)->name ?></td>
        <td><?php echo Yii::$app->Helpers->date($bid->dt_created_at); ?></td>
         <td><?php echo $bid->fk_i_token_used_id; ?></td>
        <td><?php echo $bid->s_ip_address; ?></td>
        <td><?php //echo $bid->i_status; ?>
        <select class="form-control bid-status-select" bid-id=<?php echo $bid->pk_i_id; ?> action = <?php echo Yii::$app->request->baseUrl. '/index.php?r=bid/statuschange' ?>>
  			  <option value="1" <?php echo ($bid->i_status == 1)?'selected':''?>>Requested</option>
  			  <option value="2" <?php echo ($bid->i_status == 2)?'selected':''?>>Passed</option>
  			  <option value="3" <?php echo ($bid->i_status == 3)?'selected':''?>>Accepted</option>
  			  <option value="4" <?php echo ($bid->i_status == 4)?'selected':''?>>Blocked</option>
  			</select>


        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>


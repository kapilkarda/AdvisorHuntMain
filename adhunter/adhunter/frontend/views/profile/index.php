  <!-- Profile Content -->

<?php
    use yii\widgets\ActiveForm;
?>
<div class="col-md-9">
    <div class="profile-body">
        <div class="profile-bio">
            <div class="row">
                <div class="col-md-5">
                    <?php if($model->profile_pic !=''){
                        ?>
                         <img class="img-responsive md-margin-bottom-10" width="140px" height="144px" src="assets/img/team/<?php echo $model->profile_pic ?>" alt="Profile Pic">
                        <?php
                    }else{
                        echo '<img class="img-responsive md-margin-bottom-10" src="assets/img/team/img32-md.jpg" alt="Profile Pic">';
                    }
                   
                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'error' => 'error-inline']]) ?>
                        <?= $form->field($uploadmodel, 'profile_pic')->fileInput()->label(false) ?>
                        <button class="btn-u btn-u-sm">Change Picture</button>
                    <?php ActiveForm::end() ?>
                    
                </div>
                <div class="col-md-7">
                <?php //print_r($model);?>
                    <h2><?php echo $model->first_name ?> <?php echo $model->last_name ?></h2>
                    <span><strong>Email:</strong> <?php echo $model->email ?></span>
                    <span><strong>Phone:</strong> <?php echo $model->phone ?></span>
                    <hr>

                    <span><strong>Address:</strong> <?php echo $model->location_id ?></span>
                    <span><strong>Status: </strong><?php echo ($model->status == 1)?'Active':'Deactive'; ?></span>
                </div>
            </div>
        </div><!--/end row-->

    </div>
</div>

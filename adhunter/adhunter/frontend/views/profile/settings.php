 <?php
    use webvimark\modules\UserManagement\UserManagementModule;
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;
 ?>

 <!-- Profile Content -->
            <div class="col-md-9">
                <div class="profile-body margin-bottom-20">
                    <div class="tab-v1">
                        <ul class="nav nav-justified nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#profile">Edit Profile</a></li>
                            <li><a data-toggle="tab" href="#passwordTab">Change Password</a></li>
                            <li><a data-toggle="tab" href="#payment">Payment Options</a></li>
                            <li><a data-toggle="tab" href="#settings">Notification Settings</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="profile" class="profile-edit tab-pane fade in active">
                                <h2 class="heading-md">Manage your Name, ID and Email Addresses.</h2>
                                <p>Below are the name and email addresses on file for your account.</p>
                                <br>
                                <dl class="dl-horizontal">
                                    <dt><strong>First name </strong></dt>
                                    <dd>
                                       <?php echo $model['user']['first_name'] ?>
                                        <span>
                                            <a class="pull-right" href="#">
                                                <i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
                                            </a>
                                        </span>
                                    </dd>
                                    <hr>
                                    <dt><strong>Last Name</strong></dt>
                                    <dd>
                                        <?php echo $model['user']['last_name'] ?>
                                        <span>
                                            <a class="pull-right" href="#">
                                                <i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
                                            </a>
                                        </span>
                                    </dd>
                                    <hr>
                                    <dt><strong>Email Address </strong></dt>
                                    <dd>
                                        <?php echo $model['user']['email'] ?>
                                       <!--  <span>
                                            <a class="pull-right" href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </span> -->
                                    </dd>
                                    <hr>
                                    <dt><strong>Phone Number </strong></dt>
                                    <dd>
                                        <?php echo $model['user']['phone'] ?>
                                        <span>
                                            <a class="pull-right" href="#">
                                                <i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
                                            </a>
                                        </span>
                                    </dd>
                                    <hr>
                                    <dt><strong>Address </strong></dt>
                                    <dd>
                                        <?php echo $model['user']['location_id'] ?>
                                        <span>
                                            <a class="pull-right" href="#">
                                               <i class="fa fa-pencil" data-toggle="modal" data-target="#myModal"></i>
                                            </a>
                                        </span>
                                    </dd>
                                    <hr>
                                </dl>
                                <!-- <button type="button" class="btn-u btn-u-default">Cancel</button> -->
                                <button type="button" class="btn-u">Save Changes</button>
                            </div>

                            <div id="passwordTab" class="profile-edit tab-pane fade">
                                <h2 class="heading-md">Manage your Security Settings</h2>
                                <p>Change your password.</p>
                                <br>
                                  <?php $form = ActiveForm::begin([
                                        'id'=>'user',
                                         'options' => [
                                            'class' => 'sky-form'
                                         ],
                                        // 'layout'=>'horizontal',
                                        'validateOnBlur'=>true,
                                    ]); ?>

                                    <dl class="dl-horizontal">
                                        <dt> Curret Password</dt>
                                        <dd>
                                            <section>
                                                <label class="input">
                                                    <i class="icon-append fa fa-lock"></i>
                                                    <?php if ( $model->scenario != 'restoreViaEmail' ): ?>
                                                        <?= $form->field($model, 'current_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off'])->label(false) ?>

                                                    <?php endif; ?>
                                                    <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                                </label>
                                            </section>
                                        </dd>
                                        <dt>Password</dt>
                                        <dd>
                                            <section>
                                                <label class="input">
                                                    <i class="icon-append fa fa-lock"></i>
                                                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off'])->label(false) ?>

                                                    <!-- <input type="password" id="password" name="password" placeholder="Password"> -->
                                                    <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                                </label>
                                            </section>
                                        </dd>
                                        <dt>Repeat Password</dt>
                                        <dd>
                                            <section>
                                                <label class="input">
                                                    <i class="icon-append fa fa-lock"></i>
                                                    <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off'])->label(false) ?>
                                                    <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                                </label>
                                            </section>
                                        </dd>
                                       
                                    </dl>
                                        <?= Html::submitButton(
                                            '<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('back', 'Save Changes'),
                                            ['class' => 'btn-u']
                                        ) ?>

                                    <?php ActiveForm::end(); ?>
                            </div>

                            <div id="payment" class="profile-edit tab-pane fade">
                                <h2 class="heading-md">Manage your Payment Settings</h2>
                                <p>Below are the payment options for your account.</p>
                                <br>
                                <form class="sky-form" id="sky-form" action="#">
                                    <!--Checkout-Form-->
                                    <section>
                                        <div class="inline-group">
                                            <label class="radio"><input type="radio" checked="" name="radio-inline"><i class="rounded-x"></i>Visa</label>
                                            <label class="radio"><input type="radio" name="radio-inline"><i class="rounded-x"></i>MasterCard</label>
                                            <label class="radio"><input type="radio" name="radio-inline"><i class="rounded-x"></i>PayPal</label>
                                        </div>
                                    </section>

                                    <section>
                                        <label class="input">
                                            <input type="text" name="name" placeholder="Name on card">
                                        </label>
                                    </section>

                                    <div class="row">
                                        <section class="col col-10">
                                            <label class="input">
                                                <input type="text" name="card" id="card" placeholder="Card number">
                                            </label>
                                        </section>
                                        <section class="col col-2">
                                            <label class="input">
                                                <input type="text" name="cvv" id="cvv" placeholder="CVV2">
                                            </label>
                                        </section>
                                    </div>

                                    <div class="row">
                                        <label class="label col col-4">Expiration date</label>
                                        <section class="col col-5">
                                            <label class="select">
                                                <select name="month">
                                                    <option disabled="" selected="" value="0">Month</option>
                                                    <option value="1">January</option>
                                                    <option value="1">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                                <i></i>
                                            </label>
                                        </section>
                                        <section class="col col-3">
                                            <label class="input">
                                                <input type="text" placeholder="Year" id="year" name="year">
                                            </label>
                                        </section>
                                    </div>
                                    <button type="button" class="btn-u btn-u-default">Cancel</button>
                                    <button class="btn-u" type="submit">Save Changes</button>
                                    <!--End Checkout-Form-->
                                </form>
                            </div>

                            <div id="settings" class="profile-edit tab-pane fade">
                                <h2 class="heading-md">Manage your Notifications.</h2>
                                <p>Below are the notifications you may manage.</p>
                                <br>
                                <form class="sky-form" id="sky-form3" action="#">
                                    <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Email notification</label>
                                    <hr>
                                    <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Send me email notification when a user comments on my blog</label>
                                    <hr>
                                    <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Send me email notification for the latest update</label>
                                    <hr>
                                    <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Send me email notification when a user sends me message</label>
                                    <hr>
                                    <label class="toggle"><input type="checkbox" checked="" name="checkbox-toggle-1"><i class="no-rounded"></i>Receive our monthly newsletter</label>
                                    <hr>
                                    <button type="button" class="btn-u btn-u-default">Reset</button>
                                    <button class="btn-u" type="submit">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Profile Content -->

            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Profile</h4>
                  </div>
                  <div class="modal-body">
                    <?php $form = ActiveForm::begin([
                                        'id'=>'user',
                                         'options' => [
                                            'class' => 'sky-form'
                                         ],
                                         'action' => ['profile/update'],
                                        'validateOnBlur'=>true,
                                    ]); ?>

                                    <dl class="dl-horizontal">
                                        <dt> First Name </dt>
                                        <dd>
                                            <section>
                                                <label class="input">
                                                        <input type="text" name="first_name" placeholder="First Name" value="<?php echo $model['user']['first_name'] ?>">
                                                </label>
                                            </section>
                                        </dd>
                                         <dt> Last Name </dt>
                                        <dd>
                                            <section>
                                                <label class="input">
                                                        <input type="text" name="last_name" placeholder="Last Name" value="<?php echo $model['user']['last_name'] ?>">
                                                </label>
                                            </section>
                                        </dd>
                                         <dt> Phone </dt>
                                        <dd>
                                            <section>
                                                <label class="input">
                                                        <input type="text" name="phone" placeholder="Phone" value="<?php echo $model['user']['phone'] ?>">
                                                </label>
                                            </section>
                                        </dd>
                                         <dt> Address </dt>
                                        <dd>
                                            <section>
                                                <label class="input">
                                                        <input type="text" name="location_id" placeholder="Address" value="<?php echo $model['user']['location_id'] ?>">
                                                </label>
                                            </section>
                                        </dd>                                       
                                    </dl>
                                       
                  </div>
                  <div class="modal-footer">
                   <?= Html::submitButton(
                                            '<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('back', 'Save Changes'),
                                            ['class' => 'btn-u']
                                        ) ?>

                                    <?php ActiveForm::end(); ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                  </div>
                </div>

              </div>
            </div><!--/end modal-->

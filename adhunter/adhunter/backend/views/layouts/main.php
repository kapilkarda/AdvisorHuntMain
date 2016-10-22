<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use webvimark\modules\UserManagement\components\GhostMenu;
use webvimark\modules\UserManagement\UserManagementModule;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
  <head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
  <body class="hold-transition skin-blue sidebar-mini">
  <?php $this->beginBody() ?>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">AdvisorHunter</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>AdvisorHunter</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
             <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo isset(Yii::$app->user->identity->username)?Yii::$app->user->identity->username:''; ?> </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php echo isset(Yii::$app->user->identity->username)?Yii::$app->user->identity->username:''; ?>  - Web Developer
                      <small>Member since. 2016</small>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/logout"; ?>Sign Out</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
<!--              <li>-->
<!--                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>-->
<!--              </li>-->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php  isset(Yii::$app->user->identity->username)?Yii::$app->user->identity->username:''; ?> </p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php if (Yii::$app->user->isSuperadmin) {?>
              <li class=" treeview">
                  <a href="index.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
                  </a>
              
               </li>

              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-users"></i> <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li ><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/user/index"><i class="fa fa-circle-o"></i>Credentials</a></li>
                    <li ><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=userdetails"><i class="fa fa-circle-o"></i>User</a></li>
                    <li ><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=company"><i class="fa fa-circle-o"></i>Company</a></li>
                    <li ><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=company/comments"><i class="fa fa-circle-o"></i>Reviews</a></li>
                    <li ><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=companyservicearea"><i class="fa fa-circle-o"></i>Service Areas</a></li>
                    <li ><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=companylicense"><i class="fa fa-circle-o"></i>Liecence</a></li>
                    <li ><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=backgroundcheck"><i class="fa fa-circle-o"></i>Background Check</a></li>
                    <li ><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=referral"><i class="fa fa-circle-o"></i>Referral</a></li>
                   
                  </ul>
              </li>

               <li class="treeview">
                  <a href="#">
                    <i class="fa fa-location-arrow"></i> <span>Location</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=country"><i class="fa fa-circle-o"></i> Country</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=state"><i class="fa fa-circle-o"></i> State</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=city"><i class="fa fa-circle-o"></i> City</a></li> 
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=zipcode"><i class="fa fa-circle-o"></i> Zip</a></li> 
                  </ul>
              </li>

              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-object-ungroup"></i> <span>Category</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=category"><i class="fa fa-book"></i>Category</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=subcategory"><i class="fa fa-book"></i>Sub-Category</a></li>
                  </ul>
              </li>
            
              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-question"></i> <span>Questions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=question"><i class="fa fa-book"></i>Questions</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=questiontype"><i class="fa fa-book"></i>Question Types</a></li>
                  </ul>
              </li>

               <li class="treeview">
                  <a href="#">
                    <i class="fa fa-cubes"></i> <span>Projects</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                     <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=lead"><i class="fa fa-book"></i>Leads</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=project"><i class="fa fa-book"></i>Projects</a></li>
                     <!-- <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=bid"><i class="fa fa-book"></i>Bids </a></li> -->
                  </ul>
              </li>

              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-creative-commons"></i> <span>Token</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                   <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=tokencounts"><i class="fa fa-book"></i>Price Management</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=token"><i class="fa fa-book"></i>Weightage </a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=tokenbalance"><i class="fa fa-book"></i>Balance</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=company/tokenmanagement"><i class="fa fa-book"></i>Management </a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=refund"><i class="fa fa-book"></i>	Refund</a></li>
                     <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=promocode"><i class="fa fa-book"></i>Promo Code</a></li>
                    
                  </ul>
              </li>

               <li class="treeview">
                  <a href="#">
                    <i class="fa fa-file-image-o"></i> <span>Image</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                   <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=project-image"><i class="fa fa-book"></i>Project Images</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=pro-image"><i class="fa fa-book"></i>Pro Images</a></li>
                    <li><a href="#"><i class="fa fa-book"></i>Other Images</a></li>
                  </ul>
              </li>

              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-credit-card"></i> <span>Payments</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                   <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=bilingcode"><i class="fa fa-book"></i>Billing Code</a></li>
                   <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=payment"><i class="fa fa-book"></i>Payments  </a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=customerinvoice"><i class="fa fa-book"></i>Invoice</a></li>
                  </ul>
              </li>

              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-envelope"></i> <span>Email</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                   <li><a href="#"><i class="fa fa-book"></i>News Letter Emails</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=campaignemail"><i class="fa fa-book"></i>Email Campaigns</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=campaignphonetext"><i class="fa fa-book"></i>Phone-Text Campaigns</a></li>
                    
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=email-templates"><i class="fa fa-book"></i>Email Template</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=phone-text-template"><i class="fa fa-book"></i>Phone-Text Template</a></li>
                  </ul>
              </li>

              <li class="treeview">
                  <a href="#">
                    <i class="fa fa-gears"></i> <span>Settings</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/permission/index"><i class="fa fa-circle-o"></i>Permissions</a></li> 
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/role/index"><i class="fa fa-circle-o"></i>Roles</a></li>
                    <li><a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=settings/index"><i class="fa fa-circle-o"></i>Global Settings</a></li>                    
                  </ul>
              </li>

          <?php } ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
           <?= Alert::widget() ?> 
          <?= $content ?>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://www.advisorhunter.com">Advisorhunter.com</a>.</strong> All rights reserved.
      </footer>


    </div><!-- ./wrapper -->
  
<?php $this->endBody() ?>
 <!-- jQuery 2.1.4 -->
 <!--   <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> -->

    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- AdminLTE App -->
    <script src="plugins/chartjs/Chart.min.js"></script>
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <!--  <script src="dist/js/pages/dashboard.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>

  </body>

</html>

<?php $this->endPage() ?>

<style type="text/css">
  .breadcrumb{
    margin-bottom: 0 !important;
  }
</style>


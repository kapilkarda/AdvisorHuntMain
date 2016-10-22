<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Profile | AdvisorHumter.com</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="assets_nw/css/headers/header-default.css">
    <link rel="stylesheet" href="assets/css/footers/footer-v6.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">

    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/profile.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">
    <link rel="stylesheet" href="assets/css/theme-skins/dark.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>

<div class="wrapper">
 <!--=== Header ===-->
    <?php include 'profile_header.php';?>
    <!--=== End Header ===-->
     <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . ' fade in">'.$message.'</div>';
        }
    ?>
    <!--=== Profile ===-->
    <div class="container content profile">
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <?php
                $model = \webvimark\modules\UserManagement\models\User::find()
                ->where(['id' => Yii::$app->user->identity->id])
                ->one();
                 if($model->profile_pic !=''){
                        ?>
                         <img class="img-responsive md-margin-bottom-10" width="440px" height="444" src="assets/img/team/<?php echo $model->profile_pic ?>" alt="Profile Pic">
                        <?php
                    }else{
                        echo '<img class="img-responsive md-margin-bottom-10" src="assets/img/team/img32-md.jpg" alt="Profile Pic">';
                    }
                    ?>
                <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <li class="list-group-item active">
                        <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=profile"><i class="fa fa-bar-chart-o"></i> Home</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=profile/myprofessionals"><i class="fa fa-group"></i> My Professionals</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=profile/projects"><i class="fa fa-cubes"></i> My Projects</a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=profile/settings"><i class="fa fa-cog"></i> Settings </a>
                    </li>
                    <li class="list-group-item">
                        <a href="<?php echo Yii::$app->getUrlManager()->getBaseUrl();?>/index.php?r=user-management/auth/logout"><i class="fa fa-sign-out"></i> Logout </a>
                    </li>

                </ul>

            </div>
            <!--End Left Sidebar-->
        
            <?= $content ?>
           
        </div>
    </div><!--/container-->
    <!--=== End Profile ===-->

     <!--=== Footer v6 ===-->
   <?php include 'footer.php';?>
    <!--=== End Footer v6 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="assets/plugins/counter/waypoints.min.js"></script>
<script type="text/javascript" src="assets/plugins/counter/jquery.counterup.min.js"></script>
<script type="text/javascript" src="assets/plugins/sky-forms-pro/skyforms/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="assets/plugins/scrollbar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="assets/js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/plugins/datepicker.js"></script>
<script type="text/javascript" src="assets/js/plugins/style-switcher.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initCounter();
        App.initScrollBar();
        Datepicker.initDatepicker();
        StyleSwitcher.initStyleSwitcher();
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>

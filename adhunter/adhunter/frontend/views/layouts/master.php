<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>AdvisorHunter.com</title>
<!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets_nw/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_nw/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="assets_nw/css/headers/header-default.css">
    <link rel="stylesheet" href="assets_nw/css/footers/footer-v6.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets_nw/plugins/animate.css">
    <link rel="stylesheet" href="assets_nw/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets_nw/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets_nw/css/theme-colors/default.css" id="style_color">
    <link rel="stylesheet" href="assets_nw/css/theme-skins/dark.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets_nw/css/custom.css">
<!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/page_log_reg_v1.css">
</head>

<body class="header-fixed header-fixed-space-default">

<div class="wrapper">
    <!--=== Header ===-->
    <?php include 'header.php';?>
    <!--=== End Header ===-->

    <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . ' fade in">'.$message.'</div>';
        }
    ?>
        
   <?= $content ?>

     <!--=== Footer Version 1 ===-->
 <?php include 'footer.php';?>
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->
<!-- JS Global Compulsory -->
<script type="text/javascript" src="assets_nw/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets_nw/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="assets_nw/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="assets_nw/plugins/back-to-top.js"></script>
<script type="text/javascript" src="assets_nw/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="assets_nw/plugins/jquery.parallax.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="assets_nw/js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="assets_nw/js/app.js"></script>
<script type="text/javascript" src="assets_nw/js/plugins/style-switcher.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
      	App.init();
        StyleSwitcher.initStyleSwitcher();
    });
</script>
<!--[if lt IE 9]>
    <script src="assets_nw/plugins/respond.js"></script>
    <script src="assets_nw/plugins/html5shiv.js"></script>
    <script src="assets_nw/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html>

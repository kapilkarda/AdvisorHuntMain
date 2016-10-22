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
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="data/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="data/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="data/css/headers/header-v6.css">
    <link rel="stylesheet" href="data/css/footers/footer-v6.css">
    <link rel="stylesheet" href="data/css/headers/header-default.css">


    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="data/plugins/animate.css">
    <link rel="stylesheet" href="data/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="data/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="data/plugins/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="data/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="data/plugins/master-slider/masterslider/style/masterslider.css">
    <link rel="stylesheet" href="data/plugins/master-slider/masterslider/skins/black-2/style.css">
    <link rel="stylesheet" href="data/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">
    <link rel="stylesheet" href="data/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">
    
    <link rel="stylesheet" href="data/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
    <link rel="stylesheet" href="data/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">


    <!-- CSS Pages Style -->
    <link rel="stylesheet" href="data/css/pages/page_one.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="data/css/theme-colors/default.css" id="style_color">
    <link rel="stylesheet" href="data/css/theme-skins/dark.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="data/css/custom.css">
    <!-- CSS Customization -->
    <link rel="stylesheet" href="css/site.css">
</head>
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

        <?= $content ?>

    <!--=== Footer v6 ===-->
   <?php include 'footer.php';?>
    <!--=== End Footer v6 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->
<script type="text/javascript" src="data/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="data/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="data/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="data/plugins/back-to-top.js"></script>
<script type="text/javascript" src="data/plugins/top-search.js"></script>
<script type="text/javascript" src="data/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="data/plugins/jquery.parallax.js"></script>
<script src="data/plugins/master-slider/masterslider/masterslider.min.js"></script>
<script src="data/plugins/master-slider/masterslider/jquery.easing.min.js"></script>
<script type="text/javascript" src="data/plugins/counter/waypoints.min.js"></script>
<script type="text/javascript" src="data/plugins/counter/jquery.counterup.min.js"></script>
<script type="text/javascript" src="data/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="data/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="data/js/custom.js"></script>
<!-- JS Page Level -->
<script type="text/javascript" src="data/js/app.js"></script>
<script type="text/javascript" src="data/js/plugins/fancy-box.js"></script>
<script type="text/javascript" src="data/js/plugins/owl-carousel.js"></script>
<script type="text/javascript" src="data/js/plugins/master-slider-fw.js"></script>
<script type="text/javascript" src="data/js/plugins/style-switcher.js"></script>
<script type="text/javascript" src="data/js/plugins/cube-portfolio/cube-portfolio-2.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="data/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<!-- JS Customization -->
<!-- JS Page Level -->
<script type="text/javascript" src="data/js/plugins/cube-portfolio/cube-portfolio-2.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initCounter();
        App.initParallaxBg();
        FancyBox.initFancybox();
        MSfullWidth.initMSfullWidth();
        OwlCarousel.initOwlCarousel();
        StyleSwitcher.initStyleSwitcher();
    });
</script>

<!--[if lt IE 9]>
    <script src="data/plugins/respond.js"></script>
    <script src="data/plugins/html5shiv.js"></script>
    <script src="data/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->


</html>
<?php $this->endPage() ?>

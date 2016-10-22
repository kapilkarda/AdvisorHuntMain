<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title><?php wp_title(); ?> | <?php bloginfo('name'); ?><?php if ( is_single() ) { ?> &raquo;<?php } ?></title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">

	<!-- CSS Header and Footer -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/headers/header-default.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/footers/footer-v1.css">
	
	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/animate.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/line-icons/line-icons.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/fancybox/source/jquery.fancybox.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
	<!-- CSS Theme -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/theme-colors/default.css" id="style_color">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/theme-skins/dark.css">
	<!-- CSS Customization -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css">
	<?php wp_head(); ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
	<!-- JS Global Compulsory -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/jquery/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/back-to-top.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/smoothScroll.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
	<!-- JS Customization -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/custom.js"></script>
	<!-- JS Page Level -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/app.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/forms/login.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/forms/contact.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/plugins/fancy-box.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/plugins/style-switcher.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			FancyBox.initFancybox();
			LoginForm.initLoginForm();
			ContactForm.initContactForm();
			StyleSwitcher.initStyleSwitcher();
		});
	</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
    <![endif]-->
	
</head>
<body>
<div id="wrapper" class="hfeed">
    <div id="header">
        <div id="masthead">
            <div id="access">
				<!--<div class="skip-link"><a href="#content" title="<?php _e( 'Skip to content', 'hbd-theme' ) ?>"><?php _e( 'Skip to content', 'hbd-theme' ) ?></a></div>-->
				<?php #wp_page_menu( 'sort_column=menu_order' ); ?>
				<?php //wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header' ) ); ?>
            </div><!-- #access -->
			<div class="header">
			<div class="container">
				<!-- Logo -->
				<a href="<?php echo get_site_url(); ?>" class="logo">
					<img alt="Logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo1-default.png">
				</a>
				<!-- End Logo -->

				<!-- Topbar -->
				
				<!-- End Topbar -->

				<!-- Toggle get grouped for better mobile display -->
				<button data-target=".navbar-responsive-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="fa fa-bars"></span>
				</button>
				<!-- End Toggle -->
			</div><!--/end container-->
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
				<div class="container">
									<?php wp_nav_menu( array( 'sort_column' => 'menu_order','menu_class' => 'nav navbar-nav', 'container_class' => 'menu-header' ) ); ?>

					<ul class="nav navbar-nav">
						<!-- Search Block -->
						<li>
							<i class="search fa fa-search search-btn"></i>
							<div class="search-open">
								<div class="input-group animated fadeInDown">
									<!--<label class="screen-reader-text" for="s"><?php //_x( 'Search for:', 'label' ); ?></label>-->
									<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
									<input type="text" placeholder="Search" class="form-control" value="<?php echo get_search_query(); ?>" name="s" id="s"/>
									<span class="input-group-btn">
									<input type="submit" class="btn-u" value="<?php echo esc_attr_x( 'Go', 'submit button' ); ?>" />
									</span>
									</form>
								</div>
							</div>
						</li>
						<!-- End Search Block -->
					</ul>
				</div><!--/end container-->
			</div><!--/navbar-collapse-->
		</div>
			
        </div><!-- #masthead -->
    </div><!-- #header -->
<div id="main">
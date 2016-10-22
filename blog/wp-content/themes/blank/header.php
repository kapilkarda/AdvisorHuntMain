<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title><?php wp_title( '|', true, 'right' ); ?><?php echo get_bloginfo( 'name' ); ?></title>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/style.css">
	<!--<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/dev.advisorhunter/blog/wp-content/style.css?X-Amz-Date=20160412T112323Z&X-Amz-Expires=300&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Signature=be67565cd0df5211f8bb2786535fc6fcfe478c77ef334c5704550e287cc08fae&X-Amz-Credential=ASIAIBN5CUNQ6ZR6NKUA/20160412/us-west-2/s3/aws4_request&X-Amz-SignedHeaders=Host&x-amz-security-token=FQoDYXdzEC0aDBpARG0ipI/8PgXcHCLMAsqoxNrjltApTfUT95ME5%2Bh/t561rz1WP%2BmaCB/oj7j1JKyhjm/cKBgeXQxRN5UqXsx2J4rMXnai5OI3LC5oKFQ7GrWqmaYWG/WOjZgkupXwRxyFGnvj1gcHWtGQk9XbqF16%2Ba/FX0BMqLu2z1cpJ9JgctK0D0nU0KzpxqFbxkv7vNHTpAC8vzJOVbLTm7pJxlEEcj4zx5nqvt4fKJnPAOZFKZbt8Iy/lWL18j4xMuTtGm9zGji6feIi1%2BybkZFlclPnGaisIiGRrLYwYfJ1BjTtWEOmxAfDLr9GMqJJxutWaLFijkqJoymspnbFc3fjqeyT3/rtIkT7sZ7Qyo2GQevmQiZDjYW7xs/prpafgCh1bq90KlpcfaxjhECi2FbbwqkS98SZoWUPs7umULlDEeMZny7sOLYg0Su1yY%2BFs7a8AeSG8Agm533EjbdkKIK1s7gF">-->
	<!--<link rel="stylesheet" href="https://s3-us-west-2.amazonaws.com/dev.advisorhunter/blog/wp-content/style.css">-->
	<!-- CSS Header and Footer -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/headers/header-default.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/footers/footer-v1.css">
	
	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/animate.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/line-icons/line-icons.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/font-awesome/css/font-awesome.min.css">
	<!--<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/fancybox/source/jquery.fancybox.css">-->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
	<!-- CSS Theme -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/theme-colors/default.css" id="style_color">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/theme-skins/dark.css">
	<!-- CSS Customization -->
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css">
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			FancyBox.initFancybox();
			LoginForm.initLoginForm();
			ContactForm.initContactForm();
			StyleSwitcher.initStyleSwitcher();
		});
	</script>
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
				<img alt="Logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo1-default.png" width="103" height="54">
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
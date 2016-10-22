<?php
	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'hbd-theme', TEMPLATEPATH . '/languages' );
	
	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' ); 
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable($locale_file) )
	    require_once($locale_file);

	// Get the page number
	function get_page_number() {
	    if ( get_query_var('paged') ) {
	        print ' | ' . __( 'Page ' , 'hbd-theme') . get_query_var('paged');
	    }
	} // end get_page_number

	// Custom callback to list comments in the hbd-theme style
	function custom_comments($comment, $args, $depth) {
	  $GLOBALS['comment'] = $comment;
	    $GLOBALS['comment_depth'] = $depth;
	  ?>
	    <li id="comment-<?php comment_ID() ?>" class="row blog-comments margin-bottom-30 list-unstyled">
	  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'hbd-theme') ?>
							<div class="col-sm-2 sm-margin-bottom-40">
							<?php echo get_avatar( $comment, 80 );?>
							</div>
							<div class="col-sm-10">
								<div class="comments-itself">
									<h4>
										<?php comment_author_link( $comment_ID );?>
										<span><ul class="list-unstyled list-inline"> 
										<li><?php printf(__(' %1$s at %2$s <span class="meta-sep"></span> <a href="%3$s" title="Permalink to this comment"></a>', 'hbd-theme'),
	                     
											//get_comment_date(),
											time_ago(),
											get_comment_time(),
											'#comment-' . get_comment_ID() );
											edit_comment_link(__('Edit', 'hbd-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?>
										<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/</span></li>
										<li>
												<?php 
												if($args['type'] == 'all' || get_comment_type() == 'comment') :
												comment_reply_link(array_merge($args, array(
													'reply_text' => __('Reply','hbd-theme'),
													'login_text' => __('Log in to reply.','hbd-theme'),
													'depth' => $depth,
													'before' => '<div class="comment-reply-link">',
													'after' => '</div>'
												)));
											endif;
										?></li></ul>
								</span>
									</h4>
									<p><?php comment_text() ?></p>
								</div>
							</div>
	<hr>						
	<?php } // end custom_comments
	
	
	// Custom callback to list pings
	function custom_pings($comment, $args, $depth) {
	       $GLOBALS['comment'] = $comment;
	        ?>
	            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
	                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'hbd-theme'),
	                        get_comment_author_link(),
	                        get_comment_date(),
	                       get_comment_time() );
	                        edit_comment_link(__('Edit', 'hbd-theme'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
	    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'hbd-theme') ?>
	            <div class="comment-content">
	                <?php comment_text() ?>
	            </div>
	<?php } // end custom_pings
	
	// Produces an avatar image with the hCard-compliant photo class
	function commenter_link() {
	    $commenter = get_comment_author_link();
	    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
	        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
	    } else {
	        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
	    }
	    $avatar_email = get_comment_author_email();
	    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 80 ) );
	    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
	} // end commenter_link
	
	// For category lists on category archives: Returns other categories except the current one (redundant)
	function cats_meow($glue) {
	    $current_cat = single_cat_title( '', false );
	    $separator = "\n";
	    $cats = explode( $separator, get_the_category_list($separator) );
	    foreach ( $cats as $i => $str ) {
	        if ( strstr( $str, ">$current_cat<" ) ) {
	            unset($cats[$i]);
	            break;
	        }
	    }
	    if ( empty($cats) )
	        return false;

	    return trim(join( $glue, $cats ));
	} // end cats_meow
	
	// For tag lists on tag archives: Returns other tags except the current one (redundant)
	function tag_ur_it($glue) {
	    $current_tag = single_tag_title( '', '',  false );
	    $separator = "\n";
	    $tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
	    foreach ( $tags as $i => $str ) {
	        if ( strstr( $str, ">$current_tag<" ) ) {
	            unset($tags[$i]);
	            break;
	        }
	    }
	    if ( empty($tags) )
	        return false;

	    return trim(join( $glue, $tags ));
	} // end tag_ur_it
	
	// Register widgetized areas
	function theme_widgets_init() {
	    // Area 1
	    register_sidebar( array (
	    'name' => 'Primary Widget Area',
	    'id' => 'primary_widget_area',
	    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</div>",
	    'before_title' => '<h2 class="widget-title">',
	    'after_title' => '</h2>',
	  ) );

	    // Area 2
	    register_sidebar( array (
	    'name' => 'Secondary Widget Area',
	    'id' => 'secondary_widget_area',
	    'before_widget' => '<div id="%1$s" class="widget-container %2$s margin-bottom-50">',
	    'after_widget' => "</div>",
	    'before_title' => '<h2 class="widget-title headline-v2 bg-color-light">',
	    'after_title' => '</h2>',
	  ) );
		
		
		// Area 3
	    register_sidebar( array (
	    'name' => 'Footer sidebar 1',
	    'id' => 'footer-sidebar-1',
	    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</div>",
	    'before_title' => '<div class="headline"><h2 class="widget-title">',
	    'after_title' => '</h2></div>',
	  ) );

	    // Area 4
	    register_sidebar( array (
	    'name' => 'Footer sidebar 2',
	    'id' => 'footer-sidebar-2',
	    'before_widget' => '<div id="%1$s" class="widget-container %2$s ">',
	    'after_widget' => "</div>",
	    'before_title' => '<div class="headline"><h2 class="widget-title">',
	    'after_title' => '</h2></div>',
	  ) );
		
		 // Area 5
	    register_sidebar( array (
	    'name' => 'Footer sidebar 3',
	    'id' => 'footer-sidebar-3',
	    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</div>",
	    'before_title' => '<div class="headline"><h2 class="widget-title">',
	    'after_title' => '</h2></div>',
	  ) );
		
		 // Area 6
	    register_sidebar( array (
	    'name' => 'Footer sidebar 4',
	    'id' => 'footer-sidebar-4',
	    'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	    'after_widget' => "</div>",
	    'before_title' => '<div class="headline"><h2 class="widget-title">',
	    'after_title' => '</h2></div>',
	  ) );
		
	} // end theme_widgets_init

	add_action( 'init', 'theme_widgets_init' );
	
	$preset_widgets = array (
	    'primary_widget_area'  => array( 'search', 'pages', 'categories', 'archives' ),
	    'secondary_widget_area'  => array( 'links', 'meta' )
	);
	if ( isset( $_GET['activated'] ) ) {
	    update_option( 'sidebars_widgets', $preset_widgets );
	}
	// update_option( 'sidebars_widgets', NULL );
	
	// Check for static widgets in widget-ready areas
	function is_sidebar_active( $index ){
	  global $wp_registered_sidebars;

	  $widgetcolums = wp_get_sidebars_widgets();

	  if ($widgetcolums[$index]) return true;

	    return false;
	} // end is_sidebar_active
	
	function time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';

    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');

}
?>

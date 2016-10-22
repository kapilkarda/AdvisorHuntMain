<?php get_header(); ?>
 <div class="breadcrumbs-v1">
			<div class="container">
				<h1 class="entry-title"><?php single_tag_title(); ?></h1>
			</div>
		</div>
        <div id="container" class="container content-sm">
            <div id="content" class="col-md-9">
 
 
                <?php the_post(); ?>          

				<?php if ( is_day() ) : ?>
				                <h1 class="page-title"><?php printf( __( 'Daily Archives: <span>%s</span>', 'hbd-theme' ), get_the_time(get_option('date_format')) ) ?></h1>
				<?php elseif ( is_month() ) : ?>
				                <h1 class="page-title"><?php printf( __( 'Monthly Archives: <span>%s</span>', 'hbd-theme' ), get_the_time('F Y') ) ?></h1>
				<?php elseif ( is_year() ) : ?>
				                <h1 class="page-title"><?php printf( __( 'Yearly Archives: <span>%s</span>', 'hbd-theme' ), get_the_time('Y') ) ?></h1>
				<?php elseif ( isset($_GET['paged']) && !empty($_GET['paged']) ) : ?>
				                <h1 class="page-title"><?php _e( 'Blog Archives', 'hbd-theme' ) ?></h1>
				<?php endif; ?>

				<?php rewind_posts(); ?>

				<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
				                <div id="nav-above" class="navigation">
				                    <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'hbd-theme' )) ?></div>
				                    <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'hbd-theme' )) ?></div>
				                </div><!-- #nav-above -->
				<?php } ?>            

				<?php while ( have_posts() ) : the_post(); ?>

				                <div class="row margin-bottom-20">
		<?php /* Create a div with a unique ID thanks to the_ID() and semantic classes with post_class() */ ?>
		                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php /* an h2 title */ ?>
		                    
								<?php if ( has_post_thumbnail() ) : ?>
                               
								<div class="col-sm-5 sm-margin-bottom-20">
									<?php the_post_thumbnail('medium', array( 'class' => 'img-responsive full-width' )); ?>
									<div class="clear"></div>
									</div>
                            <?php endif; ?>
							<div class="col-sm-7 news-v3"><!-- col-sm-7-->
									<div class="news-v3-in-sm no-padding">
												
												<ul class="entry-meta list-inline posted-info">
															<li class="meta-prep meta-prep-author"><?php _e('By ', 'hbd-theme'); ?>
															<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></li>
															<li>In <?php
																     $posttags = get_the_tags();
																     $count=0;
																     if ($posttags) {
																       foreach($posttags as $tag) {
																	 $count++;
																	 if (1 == $count) {
																	   echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
																	 }
																       }
																     }
																	  ?>
															</li>
															<span class="meta-prep meta-prep-entry-date"><?php _e(' ', 'hbd-theme'); ?></span>
															<li class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO') ?>"><?php the_time( get_option( 'date_format' ) ); ?></abbr></li>
															<?php edit_post_link( __( 'Edit', 'hbd-theme' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t" ) ?>
												</ul><!-- .entry-meta -->	
						
							<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( __('Permalink to %s', 'hbd-theme'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<?php /* Microformatted, translatable post meta */ ?>
		                    

		<?php /* The entry content */ ?>
		                    <div class="entry-content">
		<?php //the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'hbd-theme' )  ); ?>
						<?php
									$my_excerpt = get_the_excerpt();
									if ( '' != $my_excerpt ) {
										// Some string manipulation performed
									}
									echo $my_excerpt; // Outputs the processed value to the page
									?>
							
		<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'hbd-theme' ) . '&after=</div>') ?>
		                    </div><!-- .entry-content -->

		<?php /* Microformatted category and tag links along with a comments link */ ?>
		                    <div class="entry-utility">
		                        <!--<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in ', 'hbd-theme' ); ?></span><?php echo get_the_category_list(', '); ?></span>-->
		                        <span class="comments-link">
		                        <?php edit_post_link( __( 'Edit', 'hbd-theme' ), "<span class=\"meta-sep\">|</span>\n\t\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t\n" ) ?>
		                    </div><!-- #entry-utility -->
							
							<ul class="post-shares">
                                <li>
								   <?php comments_popup_link( __( '<i class="rounded-x icon-speech"></i>', 'hbd-theme' ), __( '<i class="rounded-x icon-speech"></i>', 'hbd-theme' ), __( '<i class="rounded-x icon-speech"></i>', 'hbd-theme' ) ) ?>
                                        <span><?php comments_popup_link( __( '0', 'hbd-theme' ), __( '1', 'hbd-theme' ), __( '%', 'hbd-theme' ) ) ?></span>
                                </li>
								
								<li><i class="rounded-x icon-share"><?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?></i></li>
                                <li><p class="like">
									<?php
									if(function_exists('like_counter_p')) { like_counter_p('<i class="rounded-x icon-heart"></i>'); }
									?></p>
								</li>
                               
                            </ul>
							
							
		                </div><!-- #post-<?php the_ID(); ?> -->
</div>
</div> <!--col-ms-7-->

		<?php /* Close up the post div and then end the loop with endwhile */ ?>      
</div>
<div class="clearfix margin-bottom-20"><hr></div>
				<?php endwhile; ?>            

				<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
				                <div id="nav-below" class="navigation">
				                    <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'hbd-theme' )) ?></div>
				                    <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'hbd-theme' )) ?></div>
				                </div><!-- #nav-below -->
				<?php } ?>                 
 
            </div><!-- #content  col-md-9-->
			<div class="col-md-3">
			<?php get_sidebar(); ?></div>
        </div><!-- #container -->
<?php get_footer(); ?>
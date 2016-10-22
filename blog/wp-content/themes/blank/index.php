<?php get_header(); ?>
<div class="breadcrumbs-v1">
			<div class="container">
				<h1 class="entry-title"><?php echo apply_filters( 'the_title', get_the_title( get_option( 'page_for_posts' ) ) );?></h1>
			</div>
		</div>
<div id="container" class="main-page container content-sm">
 
    <div id="content" class="col-md-9">
		<?php /* Top post navigation */ ?>
		<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>

		<?php } ?>
		
		<?php /* The Loop — with comments! */ ?>
		<?php while ( have_posts() ) : the_post() ?>
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
															<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a>
															</li>
															<li> <?php //the_tags( '<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links">' . __('', 'hbd-theme' ) . '</span>', ", ", "</span>\n\t\t\t\t\t\t<span class=\"meta-sep\"></span>\n" ) ?>
															<?php
																		$posttags = get_the_tags();
																		$count=0; $sep='';
																		if ($posttags) {
																			foreach($posttags as $tag) {
																				$count++;
																				echo $sep . '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
																		        $sep = ', ';
																				if( $count > 0 ) break; //change the number to adjust the count
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
								
								<li>
									<i class="rounded-x icon-share">
									<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
									</i>
								</li>
								
								
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
		
		<?php /* Bottom post navigation */ ?>
		<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
		                <ul id="" class="pager pager-v3 pager-sm margin-bottom">
									<li class="pull-left">
									<?php next_posts_link(__( '<span class="meta-nav">←</span> Older', 'hbd-theme' )) ?>
									</li>
									<li class="page-amount"> <?php echo  (get_query_var('paged')) ? get_query_var('paged') : 1;  ?> of <?php echo $total_pages;?></li>
									<li class="pull-right">
									<?php previous_posts_link(__( 'Newer <span class="meta-nav">→</span>', 'hbd-theme' )) ?>
									</li>
						</ul><!-- #nav-below -->
		<?php } ?>
		
		
    </div><!-- #content col-md-9 -->
<div class="col-md-3">
	<?php get_sidebar(); ?>
 </div>
</div><!-- #container -->
 
<?php get_footer(); ?>
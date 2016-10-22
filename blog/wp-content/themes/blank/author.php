<?php get_header(); ?>
 <div class="breadcrumbs-v1">
			<div class="container">
				<h1 class="entry-title"><?php printf( $authordata->display_name)?></h1>
			</div>
		</div>
        <div id="container" class="container content-sm">
            <div id="content" class="col-md-9">
 
                <?php the_post(); ?>          

				<h1 class="page-title author"><?php printf( __( 'Author Archives: <span class="vcard">%s</span>', 'hbd-theme' ), "<a class='url fn n' href='$authordata->user_url' title='$authordata->display_name' rel='me'>$authordata->display_name</a>" ) ?></h1>
				<?php $authordesc = $authordata->user_description; if ( !empty($authordesc) ) echo apply_filters( 'archive_meta', '<div class="archive-meta margin-bottom-20">' . $authordesc . '</div>' ); ?>

				<?php rewind_posts(); ?>

				<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
				                <ul id="" class="pager pager-v3 pager-sm margin-bottom">
									<li class="pull-left">
									<?php next_posts_link(__( '<span class="meta-nav">←</span> Older', 'hbd-theme' )) ?>
									</li>
									<li class="pull-right">
									<?php previous_posts_link(__( 'Newer <span class="meta-nav">→</span>', 'hbd-theme' )) ?>
									</li>
						</ul><!-- #nav-above-->
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
															<span class="author vcard"><?php the_author(); ?></span></li>
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
																	  ?></li>
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
				
							
							
		                </div><!-- #post-<?php the_ID(); ?> -->
</div>
</div> <!--col-ms-7-->

		<?php /* Close up the post div and then end the loop with endwhile */ ?>      
</div>

<div class="clearfix margin-bottom-20"><hr></div>
				<?php endwhile; ?>            

				<?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
								 <ul id="" class="pager pager-v3 pager-sm margin-bottom list-inline">
									<li>
										<?php previous_post_link( '%link', '<span class="meta-nav">←</span> %title' ) ?>
									</li>
									<li>
										<?php next_post_link( '%link', '%title <span class="meta-nav">→</span>' ) ?>
									</li>
								</ul><!-- #nav-below -->
								
				<?php } ?>                 
 
            </div><!-- #content -->
			<div class="col-md-3">
				<?php get_sidebar(); ?>
			</div>
        </div><!-- #container -->
 
<?php get_footer(); ?>
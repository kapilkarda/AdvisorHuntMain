<?php get_header(); ?>
 <div class="breadcrumbs-v1">
			<div class="container">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</div>
		</div>
 <div class="bg-color-light detail-page">
        <div class="container content-sm">
				<div class="row">
					<!-- Blog All Posts -->
					<div class="col-md-9">
						<!-- News v3 -->
						<?php the_post(); ?>
						<div class="news-v3 bg-color-white margin-bottom-30" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								 <div class="news-v3-in">
								 <ul class="list-inline posted-info"><h2><a href="#"><?php the_title(); ?></a></h2>
												<li class="auth-name">By <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><?php the_author(); ?></a></li>
												<li>In <?php
													   $posttags = get_the_tags();
													   $count=0; $sep='';
													   if ($posttags) {
													   foreach($posttags as $tag) {
													   $count++;
													   echo $sep . '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>';
													   $sep = ', ';
													   if( $count > 2 ) break; //change the number to adjust the count
																  }
													   }
													   ?></li>
												<li>Posted <?php echo get_the_date(); ?></li>
											</ul>
											
								 </div>
								 <?php if ( has_post_thumbnail() ) : ?>
								 <?php the_post_thumbnail('large', array( 'class' => 'img-responsive full-width' )); ?>
								 <div class="shortcode"><?php if (function_exists ('adinserter')) echo adinserter (1); ?></div> 
								<div class="clear"></div>
								 <?php endif; ?>
								 <div class="news-v3-in">	
								 <p><?php the_content(); ?></p>
								 <ul class="post-shares">
                                <li>
								   <?php comments_popup_link( __( '<i class="rounded-x icon-speech"></i>', 'hbd-theme' ), __( '<i class="rounded-x icon-speech"></i>', 'hbd-theme' ), __( '<i class="rounded-x icon-speech"></i>', 'hbd-theme' ) ) ?>
                                        <span><?php comments_popup_link( __( '0', 'hbd-theme' ), __( '1', 'hbd-theme' ), __( '%', 'hbd-theme' ) ) ?></span>
                                </li>
								
								<li><i class="rounded-x icon-share">
						
								<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?></i></li>
                                <li><p class="like">
									<?php
									if(function_exists('like_counter_p')) { like_counter_p('<i class="rounded-x icon-heart"></i>'); }
									?></p>
								</li>
                               
                            </ul>
							</div>
						</div>
						<!-- End News v3 -->

						<!-- Blog Post Author -->
						<div class="blog-author margin-bottom-30">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
							<div class="blog-author-desc">
								<div class="overflow-h">
									<h4><?php the_author(); ?></h4>
								</div>
								<p><?php the_author_description(); ?></p>
							</div>
						</div>
						<!-- End Blog Post Author -->
						<?php comments_template('', true); ?>
						</div>
					<!-- Blog Sidebar -->
					<div class="col-md-3">
						<?php get_sidebar( 'left' ); ?>
					</div>
					<!-- End Blog Sidebar -->
				</div>
			</div>
</div>			  

<?php get_footer(); ?>

<?php get_header(); ?>
 
 <div class="breadcrumbs-v1">
			<div class="container">
				<span>Blog Page</span>
					  <h1>Basic Medium Posts</h1>
			</div>
		</div>
		<div class="container content-sm">
				<div class="row">
					<div class="col-md-9">
					  <?php $the_query = new WP_Query( 'showposts=5' ); ?>
					  <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
					  <div class="row margin-bottom-20">
								 <div class="col-sm-5 sm-margin-bottom-20">
											<?php the_post_thumbnail('large', array( 'class' => 'img-responsive full-width' )); ?>
								 </div>
								 <div class="col-sm-7 news-v3">
									 <div class="news-v3-in-sm no-padding">
										 <ul class="list-inline posted-info">
											 <li>By <?php the_author() ?></li>
											 <li>In <a href="#"><?php
													   $posttags = get_the_tags();
													   $count=0;
													   if ($posttags) {
														 foreach($posttags as $tag) {
														   $count++;
														   if (1 == $count) {
															 echo $tag->name;
														   }
														 }
													   }
													   ?></a></li>
											 <li>Posted <?php the_time('M d , Y') ?></li>
										 </ul>
										 <h2><a href="#"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></a></h2>
										 <p><?php echo wp_trim_words( get_the_content(), 25, '...' );?></p>
										 </p>
										 <ul class="post-shares">
											 <li>
												 <a href="#">
													 <i class="rounded-x icon-speech"></i>
													 <span><?php wp_count_comments(); ?> </span>
												 </a>
											 </li>
											 <li><a href="#"><i class="rounded-x icon-share"></i></a></li>
											 <li><a href="#"><i class="rounded-x icon-heart"></i></a></li>
										 </ul>
									 </div>
								 </div>
					  </div>
					  <div class="clearfix margin-bottom-20"><hr></div>
					  <?php endwhile;?>
											<ul class="pager pager-v3 pager-sm no-margin-bottom">
										  <li class="previous"><a href="#">← Older</a></li>
										  <li class="page-amount">1 of 7</li>
										  <li class="next"><a href="#">Newer →</a></li>
									  </ul>
					</div>
		   <div class="col-md-3">
					  <?php get_sidebar( 'left' ); ?>
		   </div>
		   </div>
		   </div>
 
<?php get_footer(); ?>
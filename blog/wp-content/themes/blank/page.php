<?php get_header(); ?>
 
 <div class="breadcrumbs-v1">
			<div class="container">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="container content-sm">
				<div class="row">
					<div class="col-md-9">
							 <?php // theloop
        if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <h2 class="page-header"><?php the_title() ;?></h2>
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
            <?php comments_template(); ?>

        <?php endwhile; ?>
        <?php else: ?>

            <?php get_404_template(); ?>

        <?php endif; ?>
					</div>
					<div class="col-md-3">
					<?php get_sidebar( 'left' ); ?>
					</div>
				</div>
			</div>
 
<?php get_footer(); ?>
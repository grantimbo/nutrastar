<section class="portfolio-content clear">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>">
		<h1><?php the_title(); ?></h1>
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>">
				<?php the_post_thumbnail('large'); ?>
			</a>
		<?php endif; ?>
		<p><?php the_excerpt(); ?></p>
	</article><!-- /article -->
	<?php endwhile; else: ?>
		<article>
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
		</article>
		<!-- /article -->
	<?php endif; ?>
</section>
<!-- /portfolio-content -->


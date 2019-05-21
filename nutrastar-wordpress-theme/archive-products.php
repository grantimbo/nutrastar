<?php get_header(); ?>
<div class="wrap">
	<section class="portfolio-content clear">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="product-thumb-container">
		<div class="product-thumb trs-two">
			<a class="post-link" href="<?php the_permalink(); ?>" data-id="<?php the_ID(); ?>">
				<?php if(has_post_thumbnail()) : the_post_thumbnail('product-thumb'); else :?>
				<img class="trs-four" src="<?php bloginfo('template_url'); ?>/img/product-thumb.png" alt="Thumbnail does not exist">
				<?php endif; ?>
			</a>
	    </div>
	    <h3><?php the_title(); ?></h3>
	    <p><?php the_excerpt(); ?></p>
	    <button class="read-more">View Product</button>
	</div>

	<?php endwhile; else: ?>
		<article>
			<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
		</article>
		<!-- /article -->
	<?php endif; ?>
</section>
<!-- /portfolio-content -->
</div>
<?php get_footer(); ?>
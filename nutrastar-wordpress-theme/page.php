<?php get_header(); ?>
	<main role="main" class="wrap page-container">
		<section class="page-content">
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
					<?php comments_template( '', true ); // Remove if you don't want comments ?>
					<br class="clear">
					<?php edit_post_link(); ?>
				</article>
				<!-- /article -->
			<?php endwhile; ?>
			<?php else: ?>
				<article>
					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
				</article>
				<!-- /article -->
			<?php endif; ?>
		</section>
		<!-- /section -->
	</main>
	<script>
	$( document ).ajaxComplete(function( event,request, settings ) {
		$( "article" ).append( "<li>Request Complete.</li>" );
	});
	</script>
<?php get_footer(); ?>

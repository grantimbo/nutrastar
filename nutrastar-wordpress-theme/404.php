<?php get_header(); ?>

<main role="main" class="lost-page">
	<section class="wrap">
		<h1><?php _e( "404 Page", 'html5blank' ); ?></h1>
		<p>We apologize for the inconvinience,</p>
		<h2><a href="<?php echo home_url(); ?>"><?php _e( 'Go Back Home', 'html5blank' ); ?></a> or Try a Seach</h2>
		<?php get_template_part('searchform'); ?>
	</section>
	<!-- /section -->
</main>

<?php get_footer(); ?>

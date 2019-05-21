<?php get_header(); ?>
	<main role="main">
		<header class="portfolio-header trs-four">
			<?php get_template_part('navigation'); ?>
		</header>

		<div class="wrap">
			<header class="portfolio-subhead">
				<h1 class="clear"><?php single_cat_title(); ?> <span>Category<b>!</b></span></h1>
			</header>
			<?php get_template_part('loop'); ?>
			<?php get_template_part('pagination'); ?>
		</div>
	</main><!-- .portfolio-container -->
<?php get_footer(); ?>

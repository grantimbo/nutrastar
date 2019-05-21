<?php get_header(); ?>
<main role="main" class="container">
		<?php get_template_part('loop'); ?>
		<div class="clearfix"></div>
		<?php get_template_part('pagination'); ?>
		<?php posts_nav_link(); ?>
</main><!-- .container -->
<?php get_footer(); ?>

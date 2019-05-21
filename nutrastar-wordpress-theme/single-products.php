<?php get_header(); ?>
<main class="product-container wrap">

    <section class="product-single">
        <?php if (have_posts()): while (have_posts()) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <h1 class="project-title"><h2><?php the_field('product_title'); ?></h2></h1>
                <section class="sigle-product-content">
                    <?php the_content(); ?>
                    <a href="#" class="buy-amazon">Buy on Amazon</a>
                </section>            
            </article>
        <?php endwhile; endif; ?>
    </section><!-- .product-content -->
</main>
<?php get_footer(); ?>


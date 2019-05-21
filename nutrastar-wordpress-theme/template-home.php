<?php /* Template Name: Home */ get_header(); ?>


	<main class="welcome-page">
		<div class="wrap clear">
		<section class="welcome-wrap featured-header">
			<h1>Nutrastar</h1>
			<p>Nutrastart is committed to providing each customer with premium health supplements...</p>
			<a class="button" href="<?php echo site_url(); ?>/about" >Read More</a>
		</section>
		<img src="<?php bloginfo('template_url');?>/img/products.png">
		</div>
	</main>
	<!-- /welcome -->


	<main id="products" class="products-page wrap">
		<section class="welcome-products featured-header">
			<h1>Our Products</h1>
			<p>Nutrastart is committed to providing each customer with premium health supplements</p>
		</section>

		<section class="product-content clear">
			
			<?php 

			//Fix homepage pagination
            if ( get_query_var('paged') ) {
                $paged = get_query_var('paged');
            } else if ( get_query_var('page') ) {
                $paged = get_query_var('page');
            } else {
                $paged = 1;
            }
             
            $args = array( 
            	'post_type' => 'products',  
            	'orderby'=> 'menu_order',  
            	'paged' => $paged
            ); 

            $temp = $wp_query; 
            $wp_query = null; 
            $wp_query = new WP_Query(); 
            $wp_query->query( $args ); 

            if($wp_query->have_posts()) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

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
			    <a href="<?php echo get_permalink(); ?>" class="button read-more">View Product</a>
			</div>

			<?php endwhile; endif; wp_reset_postdata(); ?>

		</section>
		<!-- /product-content -->

			<?php get_template_part('pagination'); ?>
		</div>
	</main>
	<!-- /products -->

	<main id="testimonials" class="testimonials-page">
		<div class="wrap">
			<section class="welcome-testimonials featured-header">
				<h1>Testimonials</h1>
				<p>What people are saying</p>
			</section>
			<section class="testimonies clear">
				<div class="col-3">
					<img src="<?php bloginfo('template_url');?>/img/testimony-01.png" alt="">
					<h3>Cara Simps</h3>
					<span>Registered Dietritian</span>
					<p>“Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
				</div>
				<div class="col-3">
					<img src="<?php bloginfo('template_url');?>/img/testimony-02.png" alt="">
					<h3>Zak Koli</h3>
					<span>Registered Dietritian</span>
					<p>“Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
				</div>
				<div class="col-3">
					<img src="<?php bloginfo('template_url');?>/img/testimony-03.png" alt="">
					<h3>Magie Grace</h3>
					<span>Registered Dietritian</span>
					<p>“Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.”</p>
				</div>
			</section>
		</div>
	</main>
	<!-- /testimony -->


	<main id="coupons" class="coupons-page">
		<div class="wrap">
			<section class="welcome-testimonials featured-header">
				<h1>Coupons</h1>
				<p>Register For Discount Coupons & Powerful Weight Loss Tips</p>
			</section>
			
			<form action="">
				<input type="text" placeholder="Name">
				<input type="text" placeholder="Email">
				<input type="submit">
			</form>
		</div>
	</main>
	<!-- /coupons -->
<?php get_footer(); ?>
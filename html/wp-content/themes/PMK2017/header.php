<?php

/*---------------------------------------------------------------
	THEME HEADER
---------------------------------------------------------------*/


?>
<!DOCTYPE html>
	<html <?php language_attributes(); ?> class="no-js no-svg">
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php wp_head(); ?>

			<?php include('json-ld.php'); ?>

			<script type="application/ld+json">
				<?php echo json_encode($staticPayload); ?>
			</script>
			<script type="application/ld+json">
				<?php echo json_encode($dynamicPayload); ?>
			</script>
		</head>

		<body <?php body_class(); ?>>
			<div id="page" class="site">
				<a class="skip-link screen-reader-text" href="#content">
					<?php _e( 'Skip to content', 'pmk' ); ?>
				</a>

				<div class="intro-gradient">
				</div>

				<header class="main-header" role="banner">
					<?php
						if ( has_nav_menu( 'sub' ) ){
							get_template_part( 'template-parts/navigation/navigation', 'sub' );
						}
						if( has_nav_menu( 'top' ) ){
							get_template_part( 'template-parts/navigation/navigation', 'main' );
							get_template_part( 'template-parts/navigation/navigation', 'mobile' );
						}
					?>
					<button type="button" class="mobile-menu-toggle" aria-haspopup="true" aria-expanded="false" aria-controls="menu" aria-label="Navigation">
						<div class="bar bar-1"></div>
						<div class="bar bar-2"></div>
						<div class="bar bar-3"></div>
					</button>
				</header>

				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				// are we on page one?
				?>



				<?php if( pmk_is_frontpage()) : ?>

					<section class="home-hero" data-parallax="true" data-speed="0.1" data-direction="up">
						<?php the_post_thumbnail( 'pmk-featured-image' ); ?>
						<div class="home-hero__haze"></div>
						<div class="home-hero__gradient"></div>
						<div class="home-hero__lightstreak"></div>
						<div class="home-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">
							<h1 class="home-hero__heading"><span class="home-hero__sub-heading">Safe and Efficient</span> Student Dismissal</h1>
							<div class="cta-buttons">
								<a class="cta-button cta-button--secondary" type="button" href="#">
									Watch Video
									<?php echo pmk_get_svg( array( 'icon' => '32-play', 'size' => '32' ) );?>
								</a>
								<a class="cta-button cta-button--primary" type="button" href="#">
									Request Demo
									<?php echo pmk_get_svg( array( 'icon' => '32-rarrow', 'size' => '32' ) );?>
								</a>
							</div>
						</div>
						<button type="button" class="scroll-more">
							<div class="scroll-more__text">Scroll</div>
							<div class="scroll-more__line"></div>
						</button>
					</section>

				<?php elseif( is_home() && $paged == 1 ) : ?> <!-- Posts Page -->

					<div class="blog-overview-hero" data-parallax="true" data-speed="0.1" data-direction="up">
						<div class="blog-overview-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">

						<?php
							$latest = new WP_Query( array( 'posts_per_page' => 1 ) );
							while( $latest->have_posts() ) : $latest->the_post();
						?>


							<span class="blog-overview-hero__author">Written by: <span><?php echo get_the_author(); ?></span></span>
							<h1 class="blog-overview-hero__heading">
								<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
							</h1>
							<?php if(has_excerpt()): ?>
								<p class="blog-overview-hero__excerpt">
									<?php echo get_the_excerpt(); ?>
								</p>
							<?php endif; ?>

						<?php endwhile; ?>

						</div>
					</div>

				<?php elseif( is_home() && $paged != 1 ) : ?> <!-- Posts Page Paged -->

					<div class="blog-overview-hero--paged" data-parallax="true" data-speed="0.1" data-direction="up">
					</div>

				<?php else : ?>

					<div class="sub-page-hero" data-parallax="true" data-speed="0.1" data-direction="up">
						<?php the_post_thumbnail( 'pmk-featured-image' ); ?>
						<div class="sub-page-hero__haze"></div>
						<div class="sub-page-hero__gradient"></div>
						<div class="sub-page-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">
							<?php if ( $post->post_parent ) : ?>
								<a class="sub-page-hero__parent-page-link" href="<?php echo get_permalink( $post->post_parent ); ?>">
									<?php echo pmk_get_svg( array( 'icon' => '24-leftcaret', 'size' => '24' ) );?>
									<?php echo get_the_title( $post->post_parent ); ?>
								</a>
							<?php endif; ?>
							<h1><?php the_title(); ?></h1>
							<?php if(has_excerpt()): ?>
							<p><?php the_excerpt(); ?></p>
							<?php endif; ?>
						</div>
					</div>

				<?php endif; ?>



				<?php if( pmk_is_frontpage()) : ?>

					<div class="site__content site__content--home">

				<?php elseif( is_home() && $paged == 1 ) : ?>

					<div class="site__content site__content--blog">

				<?php elseif( is_home() && $paged != 1 ) : ?>

					<div class="site__content site__content--blog-paged">

				<?php else : ?>

					<div class="site__content site__content--sub">

				<?php endif; ?>

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
		</head>

		<body <?php body_class(); ?>>
			<div id="page" class="site">
				<a class="skip-link screen-reader-text" href="#content">
					<?php _e( 'Skip to content', 'pmk' ); ?>
				</a>

				<div class="intro-gradient">
				</div>



				<header class="main-header" role="banner">
					<?php if ( has_nav_menu( 'sub' ) ) : ?>
						<?php get_template_part( 'template-parts/navigation/navigation', 'sub' ); ?>
					<?php endif; ?>
					<?php get_template_part( 'template-parts/navigation/navigation', 'main' ); ?>
				</header>



				<?php if ( has_post_thumbnail() && ( is_single() || ( is_page() && ! pmk_is_frontpage() ) ) ) : ?>

					<div class="single-featured-image-header">
						<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
					</div>

				<?php elseif(has_post_thumbnail() && pmk_is_frontpage()) : ?>

					<section class="home-hero" data-parallax="true" data-speed="0.1" data-direction="up">
						<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
						<div class="home-hero__haze"></div>
						<div class="home-hero__gradient"></div>
						<div class="home-hero__lightstreak"></div>
						<div class="home-hero__content" data-parallax="true" data-speed="0.2" data-direction="up">
							<h1><span>Safe and Efficient</span> Student Dismissal</h1>
							<div class="cta-buttons">
								<a class="button button--secondary" type="button" href="#">
									Watch Video
									<?php echo pmk_get_svg( array( 'icon' => '32-play', 'size' => '32' ) );?>
								</a>
								<a class="button button--cta" type="button" href="#">
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

				<?php endif; ?>

				<div class="site__content">

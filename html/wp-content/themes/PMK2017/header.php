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


				<?php
				// If a regular post or page, and not the front page, show the featured image.
				if ( has_post_thumbnail() && ( is_single() || ( is_page() && ! twentyseventeen_is_frontpage() ) ) ) :
					echo '<div class="single-featured-image-header">';
					the_post_thumbnail( 'twentyseventeen-featured-image' );
					echo '</div><!-- .single-featured-image-header -->';
				endif;
				?>

				<div class="site-content-contain">
					<div id="content" class="site-content">

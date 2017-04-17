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

	<!-- wp-head -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content">
		<?php _e( 'Skip to content', 'pmk' ); ?>
	</a>

	<div class="intro-gradient">
	</div>

	<?php if ( has_nav_menu( 'sub' ) ) : ?>
		<?php get_template_part( 'template-parts/navigation/navigation', 'sub' ); ?>
	<?php endif; ?>

	<header class="main-header" role="banner">
		<a class="main-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php echo pmk_get_svg( array( 'icon' => 'logo' ) );?>
		</a>
	</header>

	<!--
	<header id="masthead" class="site-header" role="banner">

		<?php get_template_part( 'template-parts/header/header', 'image' ); ?>

		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="wrap">
					<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div>
			</div>
		<?php endif; ?>

	</header>
	-->

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
